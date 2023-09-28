<template>
    <!-- Header -->
    <header class="header">
        <div class="header-holder">
            <div class="burger-holder" @click="menuToggle">
                <button class="burger" :class="{ open: isActiveMenu }" aria-expanded="false" aria-controls="menu">
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                </button>
            </div>
        </div>
    </header>
    <!-- Menu -->
    <aside>
        <nav class="menu" :class="{ active: isActiveMenu }" v-show="isActiveMenu" @click="menuToggle">
            <ul>
                <li>
                    <router-link :to="{ name : 'projects'}" class="nav-link"><i class="ri-folder-open-line"></i> <span>Projects</span></router-link>
                </li>
                <li>
                    <router-link :to="{ name : 'issues'}" class="nav-link"><i class="ri-task-line"></i> <span>Issues</span></router-link>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script>
export default {
    data() {
        return {
            isActiveMenu: false,
        };
    },
    methods: {
        menuToggle () {
            this.isActiveMenu = !this.isActiveMenu
        },
    },
};
</script>
