<template>
  <div>
    <template v-if="!loading">
      <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4 mb-4">
        <div class="flex">
          <div class="flex-shrink-0">
            <ExclamationTriangleIcon class="h-5 w-5 text-yellow-400" aria-hidden="true" />
          </div>
          <div class="ml-3">
            <p class="text-sm text-yellow-700">
              Этот модуль находится в разработке
            </p>
          </div>
        </div>
      </div>
    </template>
    <loading v-else/>
  </div>
</template>

<script>
import {mapActions} from "vuex";
import Loading from "@/components/Loading.vue";
import {ExclamationTriangleIcon} from "@heroicons/vue/20/solid";

export default {
  name: "CabinetSupervisor",
  components: {
    ExclamationTriangleIcon,
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