<template>
  <component :is="layout"/>
</template>

<script>
import MainLayout from './layouts/MainLayout.vue';
import SystemLayout from './layouts/SystemLayout.vue';
import LandingLayout from "./layouts/LandingLayout.vue";
import {mapActions, mapGetters} from "vuex";

const DEFAULT_LAYOUT = 'default';
const MAIN_LAYOUT = 'main';
const SYSTEM_LAYOUT = 'system';

const LAYOUT_CONFIG = {
  [DEFAULT_LAYOUT]: LandingLayout,
  [MAIN_LAYOUT]: MainLayout,
  [SYSTEM_LAYOUT]: SystemLayout,
}
export default {
  name: 'App',
  computed: {
    ...mapGetters('auth', ['isAuthenticated']),
    layout() {
      return LAYOUT_CONFIG[this.$route?.meta?.layout || DEFAULT_LAYOUT];
    },
  },
  methods: {
    ...mapActions('cabinet', ['getInfo']),
  },
  async mounted() {
    if(this.isAuthenticated) {
      await this.getInfo()
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
