import {useToast} from "vue-toastification";
import {STORAGE_KEYS} from "@/common/const/config";
import axiosConfig from "@/common/axiosConfig";

const toast = useToast()

export default {
    signIn({commit}, payload) {
        return new Promise((resolve, reject) => {
            axiosConfig.post(`/v1/login`, payload)
                .then((res) => {
                    if(res?.data) {
                        if (res.data.token) {
                            localStorage.setItem(STORAGE_KEYS.ACCESS, res.data.token);
                            commit('setAuthData', res.data.token);
                        }
                    }
                    resolve()
                })
                .catch((err) => {
                    console.error(err)
                    toast.error(err?.response?.data?.error || 'Ошибка авторизации! Повторите позже')
                    reject()
                })
        })
    },
    signUp({commit}, payload) {
        return new Promise((resolve, reject) => {
            axiosConfig.post(`/v1/signup`, payload)
                .then((res) => {
                    if(res?.data?.success) {
                        resolve()
                    }
                })
                .catch((err) => {
                    console.error(err)
                    toast.error(err?.response?.data?.error || 'Ошибка регистрации! Повторите позже')
                    reject()
                })
        })
    },
    signOut({commit}) {
        localStorage.removeItem(STORAGE_KEYS.ACCESS);
        commit('logout');
    },
}
