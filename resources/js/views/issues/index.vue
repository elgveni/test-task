<template>
    <main class="main">
        <!-- Top -->
        <div class="top container">
            <div class="title">
                <h1>Issues</h1>
                <span>Found {{ issues.to ?? 0 }} of {{ issues.total }} records</span>
            </div>
            <div class="action">
                <router-link :to="{ name : 'issue.create'}" class="button-default button-green sidemodal--open">Create an issues</router-link>
            </div>
        </div>

        <div class="page">
            <section class="container">
                <!-- Table search -->
                <div class="table-options">
                    <div class="table-search">
                        <input type="text" class="input icon search-input" v-model="searchQuery" placeholder="General search by theme...">
                        <button
                            class="search-submit-button"
                            @click="submitSearch"
                        ><i class="ri-search-line"></i></button>
                    </div>
                    <div class="table-search">
                        <div class="select">
                            <select v-model="searchProject">
                                <option value="" disabled selected>Choose a project</option>
                                <option v-for="(item, id) in optionsProjects" :key="id" :value="item.id">{{ item.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-search">
                        <div class="select">
                            <select v-model="searchTracker">
                                <option value="" disabled selected>Choose a tracker</option>
                                <option v-for="(item, id) in optionsTrackers" :key="id" :value="item.id">{{ item.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-search">
                        <div class="select">
                            <select v-model="searchStatus">
                                <option value="" disabled selected>Choose a status</option>
                                <option v-for="(item, id) in optionsStatuses" :key="id" :value="item.id">{{ item.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-search table-search-buttons">
                        <button @click="submitSearch" class="button-default">Search</button>
                        <button @click="cancelSearch" class="button-default button-white">Cancel</button>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-holder" v-if="issues.total > 0">
                    <table>

                        <thead class="thead sticky">
                            <tr>
                                <td>#</td>
                                <td>Project</td>
                                <td>Tracker</td>
                                <td>Status</td>
                                <td>Subject</td>
                                <td>Created</td>
                                <td>Category</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>

                        <tbody>

                        <tr class="row" scope="row" v-for="(item, index) in issues.data" :key="index">
                            <td>
                                {{ item.id }}
                            </td>

                            <td>
                                <span v-if="item.project">{{ item.project.name }}</span>
                                <span v-else>-</span>
                            </td>

                            <td>
                                <span v-if="item.tracker">{{ item.tracker.name }}</span>
                                <span v-else>-</span>
                            </td>

                            <td>
                                <span v-if="item.status">{{ item.status.name }}</span>
                                <span v-else>-</span>
                            </td>

                            <td>
                                {{ item.subject }}
                            </td>

                            <td>
                                {{ formatDate(item?.created_at ?? item?.created_on) }}
                            </td>

                            <td>
                                <span v-if="item.category">{{ item.category.name }}</span>
                                <span v-else>-</span>
                            </td>

                            <td>
                                <delete-issue
                                    :name="item.name"
                                    @deleted="handleIssuesDeleted(item.id)"
                                ></delete-issue>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <pagination
                        :current-page="issues.current_page"
                        :last-page="issues.last_page"
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
import DeleteIssue from '../../components/Delete.vue';

export default {
    components: {
        Pagination,
        DeleteIssue
    },
    data() {
        return {
            issues: {},
            currentPage: 1,
            hasMorePages: false,
            searchQuery: '',
            searchProject: '',
            searchTracker: '',
            searchStatus: '',
            optionsVersions: {},
            optionsProjects: {},
            optionsTrackers: {},
            optionsStatuses: {},
            optionsCategories: {},
        };
    },
    mounted() {
        this.loadIssues();

        axios.get("/api/options/projects").then((response) => {
            this.optionsProjects = response.data;
        });

        axios.get("/api/options/trackers").then((response) => {
            this.optionsTrackers = response.data;
            this.formData.tracker_id = Object.keys(this.optionsTrackers)[0];
        });

        axios.get("/api/options/statuses").then((response) => {
            this.optionsStatuses = response.data;
            this.formData.status_id = Object.keys(this.optionsStatuses)[0];
        });
    },
    methods: {
        handlePageChange(page) {
            this.currentPage = page;
            this.loadIssues();
        },
        formatDate(rawDate) {
            const parsedDate = new Date(rawDate);
            return format(parsedDate, 'dd.MM.yyyy HH:mm:ss');
        },
        loadIssues(){
            let url = `/api/issues?page=${this.currentPage}`;

            if (this.searchQuery) {
                url += `&search=${this.searchQuery}`;
            }

            if (this.searchProject) {
                url += `&project=${this.searchProject}`;
            }

            if (this.searchTracker) {
                url += `&tracker=${this.searchTracker}`;
            }

            if (this.searchStatus) {
                url += `&status=${this.searchStatus}`;
            }

            axios.get(url).then((response) => {
                this.issues = response.data;
            });
        },
        async handleIssuesDeleted(issueId) {
            try {
                const response = await axios.delete(`/api/issues/${issueId}`);

                if (response.data.success) {
                    this.loadIssues();
                } else {
                    console.error(`Issue ID ${issueId} could not be deleted.`);
                }
            } catch (error) {
                console.error(`An error occurred while deleting the issue: ${error.message}`);
            }
        },
        submitSearch() {
            this.loadIssues();
        },
        cancelSearch() {
            this.searchQuery = '';
            this.searchProject = '';
            this.searchTracker = '';
            this.searchStatus = '';
            this.loadIssues();
        }
    },
};
</script>
