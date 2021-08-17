
const actions = {
    addUser({commit}, user) {
        commit('ADD_USER', user)
    },
    removeUser({commit}) {
        commit('REMOVE_USER')
    }
}

export default actions