<template>
    <main class="main">
        <!-- Top -->
        <div class="top container">
            <div class="title">
                <h1>Projects</h1>
                <span>Found {{ projects.to ?? 0 }} of {{ projects.total }} records</span>
            </div>
            <div class="action">
                <router-link :to="{ name : 'project.create'}" class="button-default button-green sidemodal--open">Create a project</router-link>
            </div>
        </div>

        <div class="page">
            <section class="container">
                <!-- Table search -->
                <div v-if="(config.data_source === 'database')" class="table-options">
                    <div class="table-search">
                        <input type="text" class="input icon search-input" v-model="searchQuery" placeholder="General search by name...">
                        <button
                            class="search-submit-button"
                            @click="submitSearch"
                        ><i class="ri-search-line"></i></button>
                    </div>
                    <div class="table-search--date">
                        <div class="select">
                            <select v-model="searchVersion">
                                <option value="" disabled selected>Choose a version</option>
                                <option v-for="(option, id) in optionsVersions" :key="id" :value="id">{{ option }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-search--date">
                        <div class="input-date">
                            <input name="" type="text" v-model="dateQuery" placeholder="Date" class="input icon" onfocus="(this.type='date')"
                                   onblur="if(this.value===''){this.type='text'}">
                            <i class="ri-calendar-line"></i>
                        </div>
                    </div>
                    <div class="table-search">
                        <input type="text" class="input icon search-input" v-model="searchIdentifierQuery" placeholder="General search by identifier...">
                        <button
                            class="search-submit-button"
                            @click="submitSearch"
                        ><i class="ri-search-line"></i></button>
                    </div>
                    <div class="table-search">
                        <div class="select">
                            <select v-model="searchPublic">
                                <option value="" disabled selected>Choose a public</option>
                                <option value="1">true</option>
                                <option value="0">false</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-search table-search-buttons">
                        <button @click="submitSearch" class="button-default">Search</button>
                        <button @click="cancelSearch" class="button-default button-white">Cancel</button>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-holder" v-if="projects.total > 0">
                    <table>

                        <thead class="thead sticky">
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Identifier</td>
                                <td>Is public</td>
                                <td v-if="(config.data_source === 'database')">Version</td>
                                <td>Created</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>

                        <tbody>

                        <tr class="row" scope="row" v-for="(item, index) in projects.data" :key="index">
                            <td>
                                {{ item.id }}
                            </td>

                            <td>
                                {{ item.name }}
                            </td>

                            <td>
                                {{ item.identifier }}
                            </td>

                            <td>
                                <div v-if="item.is_public"><Icons name="success" /></div>
                                <div v-else><Icons name="close" /></div>
                            </td>

                            <td v-if="(config.data_source === 'database')">
                                <span v-if="item?.version">{{ item.version.name }}</span>
                                <span v-else>-</span>
                            </td>

                            <td>
                                {{ formatDate(item?.created_at ?? item?.created_on) }}
                            </td>

                            <td>
                                <delete-project
                                    :name="item.name"
                                    @deleted="handleProjectDeleted(item.id)"
                                ></delete-project>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <pagination
                        :current-page="projects.current_page"
                        :last-page="projects.last_page"
                        :has-more-pages="hasMorePages"
                        @page-change="handlePageChange"
                    ></pagination>
                </div>

                <div v-else>
                    <div class="empty-data-message">Empty data</div>
                </div>

            </section>
        </div>
    </main>
</template>

<script setup>
    import Icons from "../../components/Icons.vue";
</script>

<script>
    import axios from 'axios';
    import { format } from 'date-fns';
    import Pagination from "../../components/Pagination.vue";
    import DeleteProject from '../../components/Delete.vue';

    export default {
        components: {
            Pagination,
            DeleteProject
        },
        data() {
            return {
                config: window.config,
                projects: {},
                currentPage: 1,
                hasMorePages: false,
                searchQuery: '',
                searchVersion: '',
                dateQuery: '',
                searchPublic: '',
                searchIdentifierQuery: '',
                optionsVersions: {},
            };
        },
        mounted() {
            this.loadProjects();

            axios.get("/api/get-version-options").then((response) => {
                this.optionsVersions = response.data;
            });
        },
        methods: {
            handlePageChange(page) {
                this.currentPage = page;
                this.loadProjects();
            },
            formatDate(rawDate) {
                const parsedDate = new Date(rawDate);
                return format(parsedDate, 'dd.MM.yyyy HH:mm:ss');
            },
            loadProjects(){
                let url = `/api/projects?page=${this.currentPage}`;

                if (this.searchQuery) {
                    url += `&search=${this.searchQuery}`;
                }

                if (this.searchVersion) {
                    url += `&version=${this.searchVersion}`;
                }

                if (this.dateQuery) {
                    url += `&date=${this.dateQuery}`;
                }

                if (this.searchPublic !== "") {
                    url += `&public=${this.searchPublic}`;
                }

                if (this.searchIdentifierQuery) {
                    url += `&identifier=${this.searchIdentifierQuery}`;
                }

                axios.get(url).then((response) => {
                    this.projects = response.data;
                });
            },
            async handleProjectDeleted(projectId) {
                try {
                    const response = await axios.delete(`/api/projects/${projectId}`);

                    if (response.data.success) {
                        this.loadProjects();
                    } else {
                        console.error(`Project ID ${projectId} could not be deleted.`);
                    }
                } catch (error) {
                    console.error(`An error occurred while deleting the project: ${error.message}`);
                }
            },
            submitSearch() {
                this.loadProjects();
            },
            cancelSearch() {
                this.searchQuery = '';
                this.searchVersion = '';
                this.dateQuery = '';
                this.searchPublic = '';
                this.searchIdentifierQuery = '';
                this.loadProjects();
            }
        },
    };
</script>
