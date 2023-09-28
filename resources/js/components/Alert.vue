<template>
    <div class="alert">
        <transition-group
            name="alert-animate"
            class="alert-messages-list"
        >
            <div
                v-for="message in messages"
                :key="message.id"
                class="alert-content"
                :class="message.status"
            >
                <div class="alert-content-text">
                    <div class="alert-message-icon">
                        <Icons :name="message.status" />
                    </div>
                    <span>{{ message.text }}</span>
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script setup>
    import Icons from "./Icons.vue";
</script>

<script>
export default {
    name: 'Alert',
    props: {
        messages: {
            type: Array,
            default: () => {
                return []
            }
        },
        timeout: {
            type: Number,
            default: 3000
        }
    },
    data () {
        return {}
    },
    watch: {
        messages () {
            this.hideAlert()
        }
    },
    mounted () {
        this.hideAlert()
    },
    methods: {
        hideAlert (messages) {
            const context = this
            if (this.messages.length) {
                setTimeout(function () {
                    // eslint-disable-next-line vue/no-mutating-props
                    context.messages.splice(context.messages.length - 1, 1)
                }, context.timeout)
            }
        }
    }
}
</script>

<style scoped>
    .alert {
        position: fixed;
        top: 5rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 99;
        font-size: var(--font-size);
    }
    .alert-messages-list {
        display: flex;
        flex-direction: column-reverse;
    }
    .alert-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        color: var(--color-white);
        height: 5rem;
        margin-bottom: 1rem;
        background-color: var(--color-green);
    }
    .alert-content-text {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .alert-message-icon {
        margin-left: 1rem;
    }
    .alert-message-icon >>> svg {
        fill: var(--color-white);
    }

    .alert .error {
        background-color: var(--color-red);
    }
    .alert .warning {
        background-color: var(--color-yellow);
    }
    .alert .success {
        background-color: var(--color-green);
    }

    .alert-animate-enter-active,
    .alert-animate-leave-active {
        transition: transform 500ms ease, opacity 500ms ease;
    }

    .alert-animate-enter,
    .alert-animate-leave-to {
        transform: translateY(10rem);
        opacity: 0;
    }
</style>
