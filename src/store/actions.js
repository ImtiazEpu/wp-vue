import Axios from "axios";
import Vue from "vue";


export const actions = {
    SAVE_SETTINGS: ({commit}, payload) => {
        let url = `${wpvkAdmin.apiURL}/wpvk/v1/settings`
        commit('SAVING')
        return new Promise((resolve, reject) => {
            Axios.post(url, {
                firstname: payload.firstname,
                lastname: payload.lastname,
                email: payload.email
            })
                .then((response) => {
                    resolve(commit('SAVED'),Vue.notify({
                        group: 'notification',
                        title: 'Saved',
                        text: 'Data has been saved',
                        type: 'success',
                        duration: 3000,
                        speed: 1000
                    }))
                })
                .catch((error) => {
                    reject(error)
                })
        })
    },

    FETCH_SETTINGS: ({commit}, payload) => {
        let url = `${wpvkAdmin.apiURL}/wpvk/v1/settings`
        return new Promise((resolve, reject) => {
            Axios.get(url)
                .then((response) => {
                    resolve(commit('UPDATE_SETTINGS', response.data))
                })
                .catch((error) => {
                    reject(error)
                })
        })
    }
}