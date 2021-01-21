export const mutations = {
    UPDATE_SETTINGS: (state, payload) => {
        state.settings.general = payload
    },
    SAVED: (state) => {
        state.loadingText = 'Save Settings'
    },
    SAVING: (state) => {
        state.loadingText = 'Saving...'
    },

    DISPLAY: (state, playload) => {
        //console.log(playload.email)
        const resutl = {
            firstname: playload.firstname,
            lastname: playload.lastname,
            email: playload.email,
        }
        state.settings.general.push(resutl)
    }

}