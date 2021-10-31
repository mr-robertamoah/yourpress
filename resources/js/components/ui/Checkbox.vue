<template>
    <div @click="clicked" class="cursor-pointer flex items-center">
        <div 
            class="mr-2 rounded h-4 w-4 border" 
            :class="{'bg-gray-100 border-gray-500': !checked, 'bg-green-400 border-green-700': checked}"
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
            class="invisible"
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
            value: {
                type: Boolean,
                default: false
            },
        },
        data() {
            return {
                checked: false
            }
        },
        watch: {
            checked(newValue, oldValue) {
                this.$emit('input', newValue)
            },
            value: {
                immediate: true,
                handler(newValue, oldValue) {
                    if (newValue === this.checked) {
                        return
                    }

                    this.checked = newValue
                }
            },
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