<template>
  <div class="divide-y questionnaire">
    <h1 class="text-2xl font-semibold pb-5">Анкета</h1>
<!--    Персональные данные-->
    <div class="grid gap-x-8 gap-y-10 py-10">
      <div>
        <h2 class="text-xl font-semibold leading-7">Персональные данные</h2>
        <p class="mt-1 text-sm leading-6 text-gray-500">Поля, отмеченные <sup class="text-red-600">*</sup>, обязательны для заполнения.</p>
      </div>

      <div class="grid grid-cols-1 gap-x-6 gap-y-3 sm:max-w-xl sm:grid-cols-6">
        <div v-if="file" ref="cropper" class="col-span-full flex items-center gap-x-3">
          <div>
            <img
                id="image"
                class="h-24 w-24 flex justify-center items-center rounded-lg bg-gray-300 object-cover"
                ref="image_new"
                :src="image_new"
                alt="Cropped Image"
            />
            <!--              <div class="flex items-center justify-center">-->
            <!--                <div @click="zoomIn" class="text-3xl font-semibold mr-6">-</div>-->
            <!--                <div @click="zoomOut" class="text-3xl font-semibold">+</div>-->
            <!--              </div>-->
          </div>
          <base-button
              type="primary"
              class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
              @click="apply"
          >
            Сохранить
          </base-button>
          <base-button
              type="secondary"
              class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
              @click="cancel"
          >
            Отменить
          </base-button>
        </div>
        <div v-else class="col-span-full flex items-center gap-x-8">
          <img
              v-if="avatarReady"
              class="h-24 w-24 flex justify-center items-center rounded-lg bg-gray-300 object-cover"
              :src="src_preview"
              alt="Cropped Image"
          />
          <div v-else class="h-24 w-24 flex justify-center items-center rounded-lg bg-gray-300 object-cover">
            <span class="text-xl font-medium leading-none">TW</span>
          </div>
          <div>
            <base-button
                type="primary"
                class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm bg-gray-400"
                @click="selectedImageHandler"
            >
              Загрузить аватар
            </base-button>
            <p class="mt-2 text-xs leading-5 text-gray-500">JPG, GIF or PNG. 1MB max.</p>
          </div>
        </div>
        <input ref="file_input" type="file" class="hidden" @change="fileSelected"/>
        <base-input
            class="col-span-full"
            disabled
            v-model="formPerson.email"
            label="E-Mail"
        />
        <base-input
            class="col-span-full"
            star
            v-model="formPerson.firstname"
            label="Имя"
        />
        <base-input
            class="col-span-full"
            star
            v-model="formPerson.lastname"
            label="Фамилия"
        />
        <base-input
            class="col-span-full"
            star
            v-model="formPerson.surname"
            label="Отчество"
        />

        <base-select
            class="col-span-full"
            label="label"
            star
            select-label="Пол"
            v-model="formPerson.gender"
            :options="gender_options"
        />

        <base-datepicker
            class="col-span-full"
            label="Дата рождения"
            star
            autoApply
            v-model="formPerson.date"
        />

        <base-select
            class="col-span-full"
            label="label"
            star
            select-label="Гражданство"
            v-model="formPerson.gender"
            :options="gender_options"
        />
      </div>
    </div>

    <!--контактная информация-->
    <div class="grid gap-x-8 gap-y-10 py-10">
      <div>
        <h2 class="text-xl font-semibold leading-7">Контактная информация</h2>
        <p class="mt-1 text-sm leading-6 text-gray-500">
          Поля, отмеченные <sup class="text-red-600">*</sup>, обязательны для заполнения.
        </p>
      </div>

      <div class="grid grid-cols-1 gap-x-6 gap-y-3 sm:max-w-xl sm:grid-cols-6">
        <BaseSelect
            class="col-span-full"
            v-model="formContacts.address"
            :options="optionsAddress"
            label="label"
            select-label="Город"
            :internal-search="false"
            :clearOnSelect="false"
            :preserveSearch="true"
            :clearable="true"
            @searchChange="onSearchChange"
        />
        <base-input
            class="col-span-full"
            star
            v-model="formContacts.phone"
            label="Мобильный телефон"
            v-maska="{mask: '+7 (###) ###-##-##', tokens: {'d':{pattern: /[1-9]/}, 'D':{pattern: /[0-9]/}, 'D':{pattern: /[0-9]/}}}"
        />
      </div>
    </div>

    <!--уровень образования !!!!-->
    <div class="grid gap-x-8 gap-y-10 py-10">
      <div>
        <h2 class="text-xl font-semibold leading-7">Уровень образования</h2>
        <p class="mt-1 text-sm leading-6 text-gray-500">
          Поля, отмеченные <sup class="text-red-600">*</sup>, обязательны для заполнения.
        </p>
        <p class="mt-1 text-sm leading-6 text-gray-500">
          Пожалуйста, укажите полное название вуза без использования аббревиатур.
        </p>
      </div>

      <div class="gap-x-6 gap-y-3 sm:max-w-xl">
        <div class="grid gap-x-6 gap-y-3 sm:max-w-xl">
          <base-select
              class="col-span-full"
              label="label"
              star
              select-label="Уровень образования"
              v-model="formPerson.gender"
              :options="gender_options"
          />
          <base-input
              class="col-span-full"
              v-model="formContacts.phone"
              label="Учебное заведение"
          />
          <BaseSelect
              class="col-span-full"
              v-model="formContacts.address"
              :options="optionsAddress"
              label="label"
              select-label="Город"
              :internal-search="false"
              :clearOnSelect="false"
              :preserveSearch="true"
              :clearable="true"
              @searchChange="onSearchChange"
          />
          <base-input
              class="col-span-full"
              star
              v-model="formContacts.phone"
              label="Специальность"
          />
          <base-select
              class="col-span-full"
              label="label"
              star
              select-label="Начало учебы"
              v-model="formPerson.gender"
              :options="gender_options"
          />
          <base-select
              class="col-span-full"
              label="label"
              star
              select-label="Завершение учебы"
              v-model="formPerson.gender"
              :options="gender_options"
          />
          <div class="text-sm mt-2 text-indigo-600 cursor-pointer">
            + Добавить ещё
          </div>
        </div>
      </div>
    </div>

    <div class="mt-4 pt-4">
      <base-button
          @click="save"
          class="sm:max-w-xl inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md">
        Сохранить
      </base-button>
    </div>
  </div>
</template>

<script>
import BaseButton from "@/components/UI/BaseButton.vue";
import BaseInput from "@/components/UI/BaseInput.vue";
import BaseSelect from "@/components/UI/BaseSelect.vue";
import BaseDatepicker from "@/components/UI/BaseDatepicker.vue";
import Cropper from "cropperjs";
import {debounce} from 'lodash'
import axiosConfig from "@/common/axiosConfig";

export default {
  name: "Questionnaire",
  components: {
    BaseDatepicker,
    BaseSelect,
    BaseButton,
    BaseInput,
    Cropper
  },
  data() {
    return {
      formPerson: {
        email: '',
        firstname: '',
        lastname: '',
        surname: '',
        gender: null,
        date: null,
      },
      formContacts: {
        address: '',
        phone: ''
      },
      gender_options: [
        {
          label: 'Мужской',
          value: 'men'
        },
        {
          label: 'Женский',
          value: 'woman'
        },
      ],
      optionsAddress: [],
      file: null,
      cropper: null,
      src_preview: null,
      reload_avatar: null,
      avatarReady: false,
      image_new: null,
      optionsSchool: [],
      test: '',

    }
  },
  methods: {
    isImageFile(file) {
      if(file.type) {
        return /^image\/\w+$/.test(file.type)
      } else {
        return /\.(jpg|jpeg|png|gif)$/.test(file)
      }
    },
    selectedImageHandler() {
      this.$refs.file_input.click()
    },
    zoomIn() {
      this.cropper.zoom(0.1)
    },
    zoomOut() {
      this.cropper.zoom(-0.1)
    },
    cancel() {
      this.file = null
      this.cropper.destroy()
    },
    fileSelected(e) {
      if(this.isImageFile(e.target.files[0])) {
        this.file = e.target.files[0]
        this.image_new = URL.createObjectURL(e.target.files[0])
        if(this.cropper !== null) {
          this.cropper.destroy()
        }
        this.cropper = new Cropper(this.image_new, {
          viewMode: 1,
          dragMode: 'move',
          aspectRatio: 1,
          autoCropArea: 0.1,
          minCropBoxWidth: 96,
          minCropBoxHeight: 96,
          restore: false,
          guides: false,
          center: false,
          highlight: false,
          cropBoxMovable: false,
          cropBoxResizable: false,
          toggleDragModeOnDblclick: false,
          responsive: true
        })
        window.cropper = this.cropper
      } else {
        console.error('Sorry, FileReader API not supported');
      }
    },
    apply() {
      this.src_preview = URL.createObjectURL(this.file.target.files[0])
      this.file = null
    },
    onSearchChange: debounce(function callback(event) {
      if (event.length >= 1) {
        this.loadAddressSuggest(event);
      }
    }, 300),
    async loadAddressSuggest(e) {
      const apiUrl = import.meta.env.VITE_APP_FIAS_URL
      const token = import.meta.env.VITE_APP_FIAS_TOKEN
      try {
        const res = await axiosConfig
            .post(
                apiUrl,
                {
                  query: e,
                  count: 10,
                },
                {
                  headers: {
                    Authorization: `Token ${token}`,
                  },
                }
            );
        if(res.data?.suggestions?.length) {
          this.optionsAddress = res.data.suggestions.map((item) => ({
            label: item.value,
            data: {
              country: item.data?.country || '',
              federalDistrict: item.data?.federal_district || '',
              area: item.data?.area || '',
              streetType: item.data?.street_type || '',
              houseType: item.data?.house_type || '',
              areaType: item.data?.area_type || '',
              block: item.data?.block || '',
              blockType: item.data?.block_type || '',
              timezone: item.data?.timezone || '',
              regionType: item.data?.region_type || "",
              region: item.data?.region || "",
              cityType: item.data?.city_type || "",
              city: item.data?.city || "",
              geolat: item.data?.geo_lat || 0,
              geolon: item.data?.geo_lon || 0,
              value: item.value || "",
              cityFiasId: item.data?.city_fias_id,
              street: item.data?.street,
              house: item.data?.house,
            },
          }))
        }
      } catch(err) {
        console.error(err)
      }
    },
    save() {
      console.log('save')
    }
  },
  mounted() {
    this.formPerson.email = 'test@test.ru'
  }
}
</script>

<style lang="scss" scoped>
.questionnaire {
  &-input--disabled {
    cursor: not-allowed;
  }
}
</style>