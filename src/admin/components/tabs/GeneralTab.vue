<template>
  <div id="wpvk-general-setting-tab" class="tab-container">
    <h2>Settings Form</h2>
    <form id="wpvk-general-setting-form" @submit="saveSettings">
      <table class="form-table" role="presentation">
        <tbody>
        <tr>
          <th scope="row">
            <label for="firstname">First Name</label>
          </th>
          <td>
            <input id="firstname" type="text" class="regular-text" v-model="formData.firstname">
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="lastname">Last Name</label>
          </th>
          <td>
            <input id="lastname" type="text" class="regular-text" v-model="formData.lastname">
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="email">Email</label>
          </th>
          <td>
            <input id="email" type="email" class="regular-text" v-model="formData.email">
          </td>
        </tr>
        </tbody>
      </table>
      <p class="submit">
        <button type="submit" class="button button-primary">{{ loadingText }}</button>
      </p>
    </form>
    <div class="clear"></div>
    <table border='1' width='80%' style='border-collapse: collapse;'>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>

      <tr v-for='data in formData'>
        <td>{{ data.firstname }}</td>
        <td>{{ data.lastname }}</td>
        <td>{{ data.email }}</td>
      </tr>
    </table>
    <div class="clear"></div>
  </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'

export default {

  name: "GeneralTab",
  data() {
    return {

    }

  },
  computed: {
    ...mapGetters(['GET_GENERAL_SETTINGS', 'GET_LOADING_TEXT']),
    formData: {
      get() {
        return this.GET_GENERAL_SETTINGS
      }
    },
    loadingText: {
      get() {
        return this.GET_LOADING_TEXT
      }
    }
  },

  mounted() {
    this.fetchSettings()
  },


  methods: {
    ...mapActions(['SAVE_SETTINGS', 'FETCH_SETTINGS']),
    saveSettings(e) {
      e.preventDefault();
      this.SAVE_SETTINGS(this.formData)
    },

    fetchSettings() {
      this.FETCH_SETTINGS()
    }
  }
}
</script>
