import Alert from '../components/Alert.vue'

export default {
    components: {
        Alert,
    },
    data() {
        return {
            alertType: '',
            alertMessage: '',
            alertDuration: 4000
        }
    },
    methods: {
        clearAlert() {
            this.alertMessage = ''
            this.alertType = ''
        },
        setSuccessAlert(msg) {
            this.alertType = AlertConstants.SUCCESS
            this.alertMessage = msg
        },
        setDangerAlert(msg) {
            this.alertType = AlertConstants.DANGER
            this.alertMessage = msg
        },
        setAlert({msg, type}) {
            if (! [AlertConstants.SUCCESS, AlertConstants.DANGER].includes(type)) {
                type = AlertConstants.SUCCESS
            }

            this.alertType = type
            this.alertMessage = msg
        },
    },
}

export const AlertConstants = {
    SUCCESS: "success",
    DANGER: 'danger',
}