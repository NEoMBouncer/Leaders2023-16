export default {
    setInfo(state, payload) {
        state.info = {
            ...payload
        }
    },
    setProfile(state, payload) {
        state.profile = {
            ...payload
        }
    },
}
