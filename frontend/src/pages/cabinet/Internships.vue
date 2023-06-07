<template>
  <div class="flex flex-col">
    <h1 class="text-2xl font-semibold pb-5">Стажировки</h1>
    <template v-if="!loading">
      <div class="flex flex-col mb-6">
        <div class="flex justify-between">
          <div class="flex w-full">
            <base-input
                label="Поиск"
                v-model="search"
            />
            <base-select
                class="ml-3 max-w-xs w-full"
                select-label="Направление"
                v-model="direction"
                :options="directoriesOptions"
                label="label"
            />
          </div>
        </div>
        <div
            v-if="clear"
            @click="clearFilters"
            class="flex items-center text-gray-600 hover:text-gray-800 h-5 cursor-pointer text-sm mt-2"
        >
          <x-mark-icon class="w-4 h-4 mr-1.5" />
          Сбросить фильтры
        </div>
        <div v-else class="mt-2 h-5"/>
        <div class="flex text-sm w-fit mt-3 items-center text-indigo-600 hover:text-indigo-900 cursor-pointer" @click="onMap">
          <MapIcon class="h-5 w-5 mr-2"/>
          Посмотреть на карте
        </div>
      </div>
      <YandexMapPage
          v-if="isMap"
          :coordsMarket="internships"
          class="mb-5"
          @closeMap="closeMap"
      />
      <div class="mb-6 space-y-3">
        <internships-card
            class="border-b border-t border-gray-200 bg-white shadow-sm sm:rounded-lg sm:border"
            v-for="product in internships" :key="product.id"
            :value="product"
        />
      </div>
    </template>
    <loading v-else/>
  </div>
</template>

<script>

import InternshipsCard from "@/components/InternshipsCard.vue";
import BaseInput from "@/components/UI/BaseInput.vue";
import BaseSelect from "@/components/UI/BaseSelect.vue";
import {XMarkIcon, MapIcon} from "@heroicons/vue/24/outline";
import {mapActions} from "vuex";
import Loading from "@/components/Loading.vue";
import YandexMapPage from "@/components/Map/YandexMap.vue";

export default {
  name: "Internships",
  components: {
    YandexMapPage,
    Loading,
    XMarkIcon, BaseSelect, BaseInput,
    InternshipsCard,
    MapIcon
  },
  data() {
    return {
      loading: false,
      search: '',
      direction: null,
      directoriesOptions: [],
      internships: [],
      isMap: false,
    }
  },
  computed: {
    clear() {
      return this.search.length || this.direction
    }
  },
  methods: {
    ...mapActions('cabinet', ['getDirections', 'getListVacancy']),
    clearFilters() {
      this.search = ''
      this.direction = null
    },
    onMap() {
      this.isMap = !this.isMap
    },
    closeMap() {
      this.isMap = false
    }
  },
  async mounted() {
    this.loading = true
    await this.getDirections().then((res) => {
      this.directoriesOptions = res?.map((item) => ({
        label: item?.title || '',
        value: item?.id || ''
      })) || []
    })
    await this.getListVacancy().then((res) => {
      this.internships = res || []
    })
    this.loading = false
  }
}
</script>

<style lang="scss" scoped>
</style>