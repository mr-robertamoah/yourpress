<template>
    <div class="mt-1 mb-2">
        <div class="form-controls">
            <form-label :htmlFor="id">{{label}}</form-label>
            <input 
                type="email" 
                :name="name" 
                :id="id" 
                class="form-input w-full"
                :class="[bottomBorder ? 'form-input-b' : 'form-input-full']"
                :placeholder="placeholder"
                :autofocus="autofocus"
                :required="required"
                :value="value"
                @input="$emit('input', $event.target.value)"
            >
        </div>
        <div class="w-full pt-1 px-2" v-if="computedExtraInfo.length">
            <p 
                v-for="(info, index) in computedExtraInfo"
                :key="index"
                class="text-left text-xs"
                :class="[errors.length ? 'text-red-400' : 'text-blue-400']"
            >{{info}}</p>
        </div>
    </div>
</template>

<script>
import FormLabel from './FormLabel.vue'
    export default {
        components: { FormLabel },
        props: {
            name: {
                type: String,
                default: ''
            },
            id: {
                type: String,
                default: ''
            },
            label: {
                type: String,
                default: ''
            },
            placeholder: {
                type: String,
                default: ''
            },
            autofocus: {
                type: Boolean,
                default: false
            },
            required: {
                type: Boolean,
                default: false
            },
            value: {
                type: String,
                default: ''
            },
            notes: {
                type: Array,
                default() {
                    return []
                }
            },
            errors: {
                type: Array,
                default() {
                    return []
                }
            },
        },
        computed: {
            computedExtraInfo() {
                return this.errors.length ? this.errors : this.notes 
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>