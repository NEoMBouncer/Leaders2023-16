import {useToast} from "vue-toastification";
import axiosConfig from "@/common/axiosConfig";

const toast = useToast()

export default {
    getInfo({commit}) {
        return new Promise((resolve, reject) => {
            axiosConfig.get(`/v1/cabinet/get-info`)
                .then((res) => {
                    if(res?.data?.data) {
                        commit('setInfo', res.data.data);
                    }
                    resolve()
                })
                .catch((err) => {
                    console.error(err)
                    toast.error(err?.response?.data?.error || 'Ошибка получения данных! Повторите позже')
                    reject()
                })
        })
    },
    getProfile({commit}) {
        return new Promise((resolve, reject) => {
            axiosConfig.get(`/v1/cabinet/profile`)
                .then((res) => {
                    if(res?.data?.data) {
                        commit('setProfile', res.data.data);
                    }
                    resolve(res?.data?.data)
                })
                .catch((err) => {
                    console.error(err)
                    toast.error(err?.response?.data?.error || 'Ошибка получения данных! Повторите позже')
                    reject()
                })
        })
    },
    setUpdateProfile({commit}, payload) {
        return new Promise((resolve, reject) => {
            axiosConfig.post(`/v1/cabinet/update-profile`, payload)
                .then((res) => {
                    if(res?.data?.success) {
                        toast.success('Успешно сохранено')
                    }
                    resolve(res?.data)
                })
                .catch((err) => {
                    console.error(err)
                    toast.error(err?.response?.data?.error || 'Ошибка сохранения данных! Повторите позже')
                    reject()
                })
        })
    },
}
