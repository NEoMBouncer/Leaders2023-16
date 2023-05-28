<template>
  <div>
    <template v-if="!loading">
    </template>
    <loading v-else/>
  </div>
</template>

<script>
import {mapActions} from "vuex";
import Loading from "@/components/Loading.vue";

export default {
  name: "CabinetSupervisor",
  components: {
    Loading,
  },
  data() {
    return {
      loading: false,
    }
  },
  computed: {
  },
  methods: {
    ...mapActions('cabinet', ['getInfo', 'getDirections', 'getCandidate', 'setCreateOrder', 'setNextStage']),
  },
  async mounted() {
    this.loading = true
    this.loading = false
  }
}
</script>

<style lang="scss" scoped>
</style>