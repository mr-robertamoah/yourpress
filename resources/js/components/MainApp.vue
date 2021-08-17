<template>
    <div>
        <the-header></the-header>
        <router-view></router-view>
    </div>
</template>

<script>
import TheHeader from './ui/TheHeader.vue'
    export default {
        components: { TheHeader },
        
    }
</script>

<style lang="scss" scoped>

</style>