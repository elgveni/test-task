<template>
    <Alert :messages="messages" />
    <main class="main">
        <!-- Top -->
        <div class="top container">
            <div class="title">
                <h1>Create an issue</h1>
            </div>
            <div class="action">
                <router-link :to="{ name : 'issues'}" class="button-default button-green sidemodal--open">Go to issues</router-link>
            </div>
        </div>

        <div class="page">
            <section class="container">
                <form @submit="submitForm">
                    <div class="sidemodal-content">
                        <div class="input-group">

                            <label class="label">
                                <span class="required">Theme</span>
                                <input v-model="formData.subject" type="text" placeholder="Theme" class="input">
                                <span v-if="errors.subject" class="error">{{ errors.subject }}</span>
                            </label>

                            <label class="label">
                                <span class="required">Project</span>
                                <div class="select">
                                    <select v-model="formData.project_id" @change="changeProject">
                                        <option value="" disabled selected>Choose a project</option>
                                        <option v-for="(item, id) in optionsProjects" :key="id" :value="item.id">{{ item.name }}</option>
                                    </select>
                                </div>
                                <span v-if="errors.project_id" class="error">{{ errors.project_id }}</span>
                            </label>

                        </div>

                        <div class="input-group">

                            <label class="label">
                                <span>Private</span>
                                <input type="checkbox" v-model="formData.is_private" value="true" />
                            </label>

                            <label class="label">
                                <span>Version</span>
                                <div class="select">
                                    <select v-model="formData.fixed_version_id" :disabled="isObjectEmpty(optionsVersions)">
                                        <option value="" disabled selected>Choose a version</option>
                                        <option v-for="(item, id) in optionsVersions" :key="id" :value="item.id">{{ item.name }}</option>
                                    </select>
                                </div>

                            </label>

                        </div>

                        <div class="input-group">

                            <label class="label">
                                <span class="required">Tracker</span>
                                <div class="select">
                                    <select v-model="formData.tracker_id">
                                        <option v-for="(item, id) in optionsTrackers" :key="id" :value="item.id">{{ item.name }}</option>
                                    </select>
                                    <span v-if="errors.tracker_id" class="error">{{ errors.tracker_id }}</span>
                                </div>
                            </label>

                            <label class="label">
                                <span>Status</span>
                                <div class="select">
                                    <select v-model="formData.status_id">
                                        <option v-for="(item, id) in optionsStatuses" :key="id" :value="item.id">{{ item.name }}</option>
                                    </select>
                                </div>
                            </label>

                        </div>

                        <div class="input-group">

                            <label class="label">
                                <span>Category</span>
                                <div class="select">
                                    <select v-model="formData.category_id" :disabled="isObjectEmpty(optionsCategories)">
                                        <option value="" disabled selected>Choose a category</option>
                                        <option v-for="(item, id) in optionsCategories" :key="id" :value="item.id">{{ item.name }}</option>
                                    </select>
                                </div>
                            </label>

                            <label class="label">
                                <span>Description</span>
                                <textarea v-model="formData.description" class="textarea"></textarea>
                            </label>

                        </div>

                    </div>
                    <div class="sidemodal-footer">
                        <button class="button-default button-submit">Save</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</template>

<script setup>
import Alert from "../../components/Alert.vue";
</script>

<script>
import axios from 'axios';
import router from "../../routes/index.js";

export default {
    data() {
        return {
            formData: {
                subject: "",
                description: "",
                is_private: true,
                fixed_version_id: "",
                parent_id: "",
                project_id: "",
                tracker_id: "",
                status_id: "",
                category_id: ""
            },
            optionsVersions: {},
            optionsProjects: {},
            optionsTrackers: {},
            optionsStatuses: {},
            optionsCategories: {},
            errors: {},
            messages: []
        };
    },
    mounted() {

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
        isObjectEmpty(obj) {
            return Object.keys(obj).length === 0;
        },
        validateForm() {
            this.errors = {};

            if (!this.formData.subject) {
                this.errors.subject = "Theme is required!";
            }

            if (!this.formData.project_id) {
                this.errors.project_id = "Project is required!";
            }

            if (!this.formData.tracker_id) {
                this.errors.tracker_id = "Tracker is required!";
            }
        },
        async changeProject(event) {
            const foundObject = this.optionsProjects.find(obj => obj.id === this.formData.project_id);
            let identifier = '';
            if (foundObject) {
                identifier = foundObject.identifier;
            }
            if (identifier !== '') {
                axios.get(`/api/issues/options/versions/${identifier}`).then((response) => {
                    this.optionsVersions = response.data;
                });
                axios.get(`/api/issues/options/categories/${identifier}`).then((response) => {
                    this.optionsCategories = response.data;
                });

            }
        },
        async submitForm(event) {
            event.preventDefault();
            this.validateForm();

            if (Object.keys(this.errors).length === 0) {
                try {
                    const response = await axios.post('/api/issues/add', this.formData);
                    this.showAlert('The issue was successfully created. Now you can go to the Issues page');
                    setTimeout(async () => {
                        await router.push('/issues');
                    }, 2000);
                } catch (error) {
                    console.error('An error occurred while sending to the server', error);
                }
            }
        },
        showAlert (textMessage, statusMess = 'success') {
            const timeStamp = Date.now().toLocaleString()
            this.messages.unshift(
                { text: textMessage, status: statusMess, id: timeStamp }
            )
        }
    },
};
</script>
