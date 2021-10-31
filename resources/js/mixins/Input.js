import DefaultInput from '../components/ui/DefaultInput.vue'

export default {
    components: {
        DefaultInput,
    },
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
        bottomBorder: {
            type: Boolean,
            default: false
        },
        required: {
            type: Boolean,
            default: false
        },
        disabled: {
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
}