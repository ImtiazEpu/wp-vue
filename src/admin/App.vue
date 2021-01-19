<template>
  <div id="vue-backend-app">
    <notifications group="notification" position="top right" />
    <h1>Wp Vue Heading</h1>
    <router-view name="tab"></router-view>
    <router-view></router-view>

  </div>
</template>

<script>
export default {
  name: "App"
}
</script>
