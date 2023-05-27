export default {
    setInfo(state, payload) {
        console.log(1, payload)
        state.info = payload
    },
    setProfile(state, payload) {
        state.profile = payload
    },
    setEssay(state, payload) {
        state.essat = payload
    },
}
