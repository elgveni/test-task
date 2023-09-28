<template>
    <Alert :messages="messages" />
    <main class="main">
        <!-- Top -->
        <div class="top container">
            <div class="title">
                <h1>Create a project</h1>
            </div>
            <div class="action">
                <router-link :to="{ name : 'projects'}" class="button-default button-green sidemodal--open">Go to projects</router-link>
            </div>
        </div>

        <div class="page">
            <section class="container">
                <form @submit="submitForm">
                    <div class="sidemodal-content">
                        <div class="input-group">

                            <label class="label">
                                <span class="required">Name</span>
                                <input v-model="formData.name" type="text" placeholder="Name" class="input">
                                <span v-if="errors.name" class="error">{{ errors.name }}</span>
                            </label>

                            <label class="label">
                                <span>Version</span>
                                <div class="select">
                                    <select v-model="formData.default_version_id">
                                        <option value="" disabled selected>Choose a version</option>
                                        <option v-for="(option, id) in optionsVersions" :key="id" :value="id">{{ option }}</option>
                                    </select>
                                </div>
                            </label>

                        </div>

                        <div class="input-group">

                            <label class="label">
                                <span>Public</span>
                                <input type="checkbox" v-model="formData.is_public" value="true" />
                            </label>

                            <label class="label">
                                <span>Subproject of</span>
                                <div class="select">
                                    <select v-model="formData.parent_id">
                                        <option value="" disabled selected>Choose a subproject</option>
                                        <option v-for="(option, id) in optionsSubProjects" :key="id" :value="id">{{ option }}</option>
                                    </select>
                                </div>
                            </label>

                        </div>

                        <div class="input-group">

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
                    name: "",
                    description: "",
                    is_public: true,
                    default_version_id: "",
                    parent_id: "",
                },
                optionsVersions: {},
                optionsSubProjects: {},
                errors: {},
                messages: []
            };
        },
        mounted() {
            axios.get("/api/get-version-options").then((response) => {
                this.optionsVersions = response.data;
            });

            axios.get("/api/get-project-options").then((response) => {
                this.optionsSubProjects = response.data;
            });
        },
        methods: {
            validateForm() {
                this.errors = {};

                if (!this.formData.name) {
                    this.errors.name = "Name is required!";
                }
            },
            async submitForm(event) {
                event.preventDefault();
                this.validateForm();

                if (Object.keys(this.errors).length === 0) {
                    try {
                        const response = await axios.post('/api/projects/add', this.formData);
                        this.showAlert('The project was successfully created. Now you can go to the Projects page');
                        setTimeout(async () => {
                            await router.push('/projects');
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
