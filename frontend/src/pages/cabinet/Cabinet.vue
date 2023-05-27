<template>
  <div class="flex flex-col">
    <h1 class="text-2xl font-semibold pb-5">Кабинет</h1>
    <!--ROLE_CANDIDATE-->
    <template v-if="info.role === 0">
      <cabinet-candidate/>
    </template>
  </div>
</template>

<script>

import {mapState} from "vuex";
import CabinetCandidate from "@/components/layoutRoles/CabinetCandidate.vue";

export default {
  name: "Cabinet",
  components: {
    CabinetCandidate
  },
  data() {
    return {
    }
  },
  computed: {
    ...mapState('cabinet', ['info']),
  },
  methods: {
  },
  mounted() {
  }
}
</script>

<style lang="scss" scoped>
</style>