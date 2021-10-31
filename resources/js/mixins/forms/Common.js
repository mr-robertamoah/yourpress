import FormSection from '../../components/layouts/FormSection.vue'
import LoginRegisterCard from '../../components/login/LoginRegisterCard.vue'
import LoginRegisterForm from '../../components/login/LoginRegisterForm.vue'
import LoginRegisterLayout from '../../components/login/LoginRegisterLayout.vue'
import EmailInput from '../../components/ui/EmailInput.vue'
import PasswordInput from '../../components/ui/PasswordInput.vue'
import PrimaryButton from '../../components/ui/PrimaryButton.vue'
import TextInput from '../../components/ui/TextInput.vue'

export default {
    components: {
        LoginRegisterLayout,
        LoginRegisterForm,
        LoginRegisterCard,
        TextInput,
        FormSection,
        EmailInput,
        PasswordInput,
        PrimaryButton,
    },
    data() {
        return {
            loading: false
        }
    },
    methods: {
        setResponseErrors(errors) {
            if (! errors) {
                return
            }

            let property
            for (const errorName in errors) {
                property = errorName

                if (property === 'username') {
                    property = 'userName'
                }
                
                if (property === 'password_confirmation') {
                    property = 'passwordConfirmation'
                }

                this.setError({
                    errors: errors[property],
                    property,
                })
            }
        },
        setError({error, property, errors}) {
            
            let propertyError = `${property}Errors`

            if (! this.formData.hasOwnProperty(propertyError)) {
                return
            }

            if (error) {
                this.formData[propertyError].unshift(error)
            }

            if (errors?.length) {
                this.formData[propertyError] = [...errors]
            }

            if ("setCurrentSection" in this) {
                this.setCurrentSection(property)
            }
        },
        clearError(property) {
            let propertyError = `${property}Errors`
            if (! this.formData[propertyError]?.length) {
                return
            }

            this.formData[propertyError] = []
        },
    },
}