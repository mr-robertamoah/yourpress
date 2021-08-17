<template>
    <form @submit.prevent="submitForm">
        <h1 
            class="text-2xl font-black capitalize tracking-wider text-center mb-5 border-b-2 relative"
        >{{heading}}</h1>
        <slot></slot>
        <div class="w-full pt-1 border-t-2" v-if="computedTotalSections.length > 2">
            <div 
                class="w-5 h-1 bg-green-300"
                v-for="(section, index) of computedTotalSections"
                :key="index"
            ></div>
        </div>
        <div 
            class="absolute top-0 left-0 w-full h-full bg-gray-500
                flex justify-center items-center bg-opacity-75 text-white animate-bounce"
            v-if="loading"
        >
            {{loadingMsg}}
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            heading: {
                type: String,
                default: ''
            },
            totalSections: {
                type: Number,
                default: 1
            },
            currentSection: {
                type: Number,
                default: 1
            },
            loading: {
                type: Boolean,
                default: false
            },
            loadingMsg: {
                type: String,
                default: ''
            },
        },
        computed: {
            computedTotalSections() {
                return this.totalSections > 1 ? Array(this.totalSections)  : []
            }
        },
        methods: {
            submitForm() {
                this.$emit('submitForm')
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>