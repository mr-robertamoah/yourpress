<template>
    <div>
        <span>info</span>
        <profile-card>
            <slot></slot>
        </profile-card>
    </div>
</template>

<script>
import ProfileCard from './ProfileCard.vue'
    export default {
  components: { ProfileCard },
        
    }
</script>

<style lang="scss" scoped>

</style>