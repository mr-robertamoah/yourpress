<template>
    <div @click="clicked" class="cursor-pointer">
        <div 
            class="w-3 h-3" 
            :class="{'bg-gray-500': !checked, 'bg-green-400': checked}"
        ></div>
        <div class="text-sm">
            <slot></slot>
        </div>
        <input 
            :ref="this.computedRef" 
            v-model="checked" 
            type="checkbox" 
            name="" 
            id="" 
            @change="!checked"
            class=""
        >
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                type: String,
                default: ''
            },
        },
        data() {
            return {
                checked: false
            }
        },
        computed: {
            computedRef() {
                return 'checkbox' + this.id.length ? ` ${this.id}` : ''
            }
        },
        methods: {
            clicked() {
                this.checked = !this.checked
                this.$refs[this.computedRef].checked = this.checked
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>