<template>
    <div class="row-controls">
        <div class="title">Definitions</div>
        <button @click="confirmDelete">
            <i class="ri-close-line"></i>
        </button>
    </div>
    <div class="modal" v-if="showConfirmation">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <p>Are you sure you want to delete the "{{ name }}?</p>
            <div class="sidemodal-footer">
                <button @click="deleteElement" class="button-default">Yes</button>
                <button @click="cancelDelete" class="button-default button-white">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        name: String,
    },
    data() {
        return {
            showConfirmation: false,
        };
    },
    methods: {
        confirmDelete() {
            this.showConfirmation = true;
        },
        cancelDelete() {
            this.showConfirmation = false;
        },
        deleteElement() {
            this.$emit('deleted');
            this.showConfirmation = false;
        },
    },
};
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    z-index: 200;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 100;
}
</style>
