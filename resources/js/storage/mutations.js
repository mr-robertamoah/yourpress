
const mutations = {
    "ADD_USER"(state, user) {
        state.user = user
    },
    "REMOVE_USER"(state) {
        state.user = null
    }
}

export default mutations