<template>
    <div v-if="(pages.length > 1)" class="pagination-holder">
        <ul>
            <li :class="{ 'disabled': currentPage === 1 }">
                <a @click.prevent="previousPage" href="#">&laquo;</a>
            </li>
            <li v-for="page in pages" :key="page" :class="{ 'active': currentPage === page }">
                <a @click.prevent="goToPage(page)" href="#">{{ page }}</a>
            </li>
            <li :class="{ 'disabled': !hasMorePages }">
                <a @click.prevent="nextPage" href="#">&raquo;</a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        currentPage: Number,
        lastPage: Number,
        hasMorePages: Boolean,
    },
    computed: {
        pages() {
            const pagesArray = [];
            console.log(this.lastPage);
            for (let page = 1; page <= this.lastPage; page++) {
                pagesArray.push(page);
            }

            return pagesArray;
        },
    },
    methods: {
        previousPage() {
            if (this.currentPage > 1) {
                this.$emit('page-change', this.currentPage - 1);
            }
        },
        nextPage() {
            if (this.hasMorePages) {
                this.$emit('page-change', this.currentPage + 1);
            }
        },
        goToPage(page) {
            if (this.currentPage !== page) {
                this.$emit('page-change', page);
            }
        },
    },
};
</script>
