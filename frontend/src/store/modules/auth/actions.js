import axios from "axios";
import {useToast} from "vue-toastification";
import {STORAGE_KEYS} from "@/common/const/config";

const API_URL = import.meta.env.VITE_APP_API_URL
const toast = useToast()

export default {
    // getMe
    signIn({commit}, payload) {
        return new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('username', payload.username);
            formData.append('password', payload.password);
            axios.post(`${API_URL}/auth/login`, formData)
                .then((res) => {
                    if(res?.data) {
                        if (res.data.access_token) {
                            localStorage.setItem(STORAGE_KEYS.ACCESS, res.data.access_token);
                            commit('setAuthData', res.data.access_token);
                        }
                    }
                    resolve()
                })
                .catch((err) => {
                    console.error(err)
                    toast.error(err?.response?.data?.detail || 'Ошибка авторизации! Повторите позже')
                    reject()
                })
        })
    },
    signOut({commit}) {
        localStorage.removeItem(STORAGE_KEYS.ACCESS);
        commit('logout');
    },
}
