<template>
  <div class="yandex-map-wrapper">
    <XMarkIcon @click="closeMap" class="yandex-map-wrapper__close"/>
    <yandex-map
        class="yandex-map"
        :coords="coordsMarket.length ? coordsMarket : mapConfig.coords"
        :zoom="coordsMarket.length ? 16 : mapConfig.zoom"
        :controls="[]"
        :settings="settings"
        @click="onClick"
    >
      <ymap-marker
          :coords="coordsMarket"
          marker-id="1"
          :hint-content="nameAddress"
      />
    </yandex-map>
  </div>
</template>

<script>
import { yandexMap, ymapMarker } from 'vue-yandex-maps'
import config from "@/common/const/config";
import BaseInput from "@/components/UI/BaseInput.vue";
import BaseButton from "@/components/UI/BaseButton.vue";
import {
  XMarkIcon,
} from '@heroicons/vue/24/outline'

const MOSCOW_COORDS = [37.61556, 55.75222]
const DEFAULT_ZOOM = 10
const settings = {
  apiKey: config.keyYandexMap,
  lang: 'ru_RU',
  coordorder: 'longlat',
  enterprise: false,
  version: '2.1'
}

export default {
  name: 'YandexMapPage',
  components: {
    BaseButton,
    BaseInput,
    yandexMap,
    ymapMarker,
    XMarkIcon
  },
  props: {
    nameAddress: {
      type: String,
      default: ''
    },
    coordsMarket: {
      type: Array,
    },
    address: {
      type: Object,
      default: null
    },
  },
  data() {
    return {
      mapConfig: {
        zoom: DEFAULT_ZOOM,
        coords: MOSCOW_COORDS,
        showAllMarkers: true,
      },
      settings,
    }
  },
  computed: {
    city() {
      return this.address?.data?.city || 'Москва'
    },
    street() {
      return this.address?.data?.street || ''
    },
  },
  methods: {
    onClick(e) {
      if(e.originalEvent) {
        this.$emit('newCoords', e.get('coords'));
        this.mapConfig.coords = e.get('coords')
      }
    },
    closeMap() {
      this.$emit('closeMap');
    }
  },
}
</script>

<style lang="scss" scoped>

.yandex-map-wrapper {
  position: relative;
  max-height: 500px;
  .yandex-map {
    @apply w-full;
    height: 500px;
  }
  .yandex-map-form {
    @apply flex flex-col bg-white px-4 py-3;
    position: absolute;
    top: 18px;
    left: 20px;
    z-index: 2;
    width: min(300px, 100%);
  }
  &__close {
    @apply w-7 h-7 absolute right-2 top-2 cursor-pointer;
    z-index: 2;
  }
}
</style>