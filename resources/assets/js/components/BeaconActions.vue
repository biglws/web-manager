<template>
  <div class="beacons-form">
    <div v-if="action === 'add'">
      <h3>Добавить новый</h3>
    </div>
    <div v-else>
      <h3>Редактировать</h3>
    </div>
    <el-form :label-position="labelPosition" :model="beacon">
      <el-form-item label="Наименование">
        <el-input placeholder="Наименование" v-model="beacon.name" autofocus />
      </el-form-item>
      <el-form-item label="Идентификатор">
        <el-input placeholder="Идентификатор" v-model="beacon.identity" />
      </el-form-item>
      <el-form-item label="Дата покупки">
        <el-date-picker
          v-model="beacon.buyed_at"
          type="date"
          placeholder="Дата покупки"
        />
      </el-form-item>
    </el-form>
    <div v-if="action === 'add'">
      <el-button type="primary" icon="plus" @click="handleAdd(beacon)">
        Добавить
      </el-button>
    </div>
    <div v-else>
      <el-button type="primary" icon="edit" @click="handleEdit(beacon)">
        Изменить
      </el-button>
    </div>
  </div>
</template>

<script>

 export default {
   props: {
     action: {
       type: String,
       default: 'add'
     },
     beacon: {
       type: Object
     }
   },
   data() {
     return {
       labelPosition: 'top'
     }
   },
   methods: {
     handleAdd: function (beacon) {
       if (this.beacon.name.length > 0 && this.beacon.identity.length > 0) {
         Bus.$emit('beacon_creating', beacon)
       }
     },
     handleEdit: function (beacon) {
       Bus.$emit('beacon_updating', beacon)
     }
   }
 }
</script>


