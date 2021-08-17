<template>
    <div 
        class="max-w-80 shadow rounded duration-1000 text-sm p-2 text-left static top-1 
            transition-alert mx-auto"
        :class="{'bg-red-800 text-red-300': type === 'success', 
            'bg-green-800 text-green-300': type === 'danger',
            'visible opacity-100 w-full left-0': message.length,
            'invisible opacity-0 left-80': !message.length}"
    >
        {{message}}
    </div>
</template>

<script>
    export default {
        props: {
            message: {
                type: String,
                default: ''
            },
            type: {
                type: String,
                default: 'success'
            },
            duration: {
                type: Number,
                default: 4000
            },
        },
        watch: {
            message: {
                immediate: true,
                handler(newValue, oldValue) {
                    this.setTimeout()
                }
            }
        },
        methods: {
            setTimeout() {
                if (! this.message?.length) {
                    return
                }

                setTimeout(() => {
                    this.clearAlert()        
                }, this.duration);
            },
            clearAlert() {
                this.$emit('clearAlert')
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>