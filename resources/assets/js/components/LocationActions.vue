<template>
  <div class="location-form">
    <div v-if="action === 'add'">
      <h3>Добавить новое помещение</h3>
    </div>
    <div v-else>
      <h3>Редактировать</h3>
    </div>
    <el-form :label-position="labelPosition" :model="location">
      <el-row :gutter="10">
        <el-col :span="12">
          <el-form-item label="Наименование">
            <el-input placeholder="Наименование" v-model="location.name" autofocus />
          </el-form-item>
        </el-col>
        <el-col :span="12">
          <el-form-item label="Описание">
            <el-input placeholder="Краткое описание" v-model="location.description" />
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="10">
        <el-col :span="24">
          <h4>Точки</h4>
          <div
            v-for="(point, pointIndex) in location.boundary_points"
            :key="point.key">
            <el-row :gutter="10">
              <el-col :span="9">
                <el-form-item label="X">
                  <el-input v-model="point.x" />
                </el-form-item>
              </el-col>
              <el-col :span="9">
                <el-form-item label="Y">
                  <el-input v-model="point.y" />
                </el-form-item>
              </el-col>
              <el-col :span="3">
                <el-form-item label="Сегмент">
                  <el-button type="success" icon="plus" @click="addSegment(pointIndex, point)" />
                </el-form-item>
              </el-col>
              <el-col :span="3">
                <el-form-item label="Удалить">
                  <el-button type="danger" icon="delete" @click.prevent="removePoint(pointIndex, point)" />
                </el-form-item>
              </el-col>
            </el-row>
            <el-row
              v-for="(segment, segmentIndex) in point.boundary_segments"
              :key="point.key"
              :gutter="10"
            >
              <el-col :offset="2" :span="2">
                <el-form-item label="#">
                  <el-input size="mini" :value="segmentIndex" :disabled="true"/>
                </el-form-item>
              </el-col>
              <el-col :span="4">
                <el-form-item label="Маячок">
                  <el-select size="mini" v-model="segment.beacon_id" clearable placeholder="...">
                    <el-option
                      v-for="beacon in beacons"
                      :key="beacon.id"
                      :label="beacon.name"
                      :value="beacon.id">
                    </el-option>
                  </el-select>
                </el-form-item>
              </el-col>
              <el-col :span="4">
                <el-form-item label="Сегмент №">
                  <el-input size="mini" v-model="segment.segment_no" />
                </el-form-item>
              </el-col>
              <el-col :span="4">
                <el-form-item label="Расстояние">
                  <el-input size="mini" v-model="segment.distance" />
                </el-form-item>
              </el-col>
              <el-col :span="5">
                <el-form-item label="Откуда">
                  <el-radio-group size="mini" v-model="segment.from_side">
                    <el-radio-button label="left">Слева</el-radio-button>
                    <el-radio-button label="right">Справа</el-radio-button>
                  </el-radio-group>
                </el-form-item>
              </el-col>
              <el-col :span="2">
                <el-form-item label="Удалить">
                  <el-button size="mini" type="danger" icon="delete" @click.prevent="removeSegment(pointIndex, segmentIndex, segment)" />
                </el-form-item>
              </el-col>
            </el-row>
          </div>
          <el-button type="warning" size="mini" icon="plus" @click="addPoint()">
            Добавить точку
          </el-button>
        </el-col>
      </el-row>
    </el-form>
    <br><br>
    <div v-if="action === 'add'">
      <el-button type="primary" icon="plus" @click="handleAdd(location)">
        Добавить
      </el-button>
    </div>
    <div v-else>
      <el-button type="primary" icon="edit" @click="handleEdit(location)">
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
     location: {
       type: Object,
       required: true
     },
     beacons: {
       type: Array,
       required: true
     }
   },
   data() {
     return {
       labelPosition: 'top',
     }
   },
   methods: {
     handleAdd: function (location) {
       Bus.$emit('location_creating', location)
     },
     handleEdit: function (location) {
       Bus.$emit('location_updating', location)
     },
     addPoint: function () {
       Bus.$emit('location_bp_creating')
     },
     addSegment: function (pointIndex, point) {
       Bus.$emit('location_bs_creating', pointIndex, point)
     },
     removeSegment: function (pointIndex, segmentIndex, segment) {
       if (this.action === 'edit') {
         this.$confirm('Сегмент будет удален. Продолжить?', 'Внимание', {
           confirmButtonText: 'Удалить',
           cancelButtonText: 'Отмена',
           type: 'warning'
         }).then(() => {
           Bus.$emit('location_bs_deleting', pointIndex, segmentIndex, segment)
         })
       } else {
         Bus.$emit('location_bs_deleting', pointIndex, segmentIndex, segment)
       }
     },
     removePoint: function (index, boundaryPoint) {
       if (this.action === 'edit') {
         this.$confirm('Точка будет удалена. Продолжить?', 'Внимание', {
           confirmButtonText: 'Удалить',
           cancelButtonText: 'Отмена',
           type: 'warning'
         }).then(() => {
           Bus.$emit('location_bp_deleting', index, boundaryPoint)
         })
       } else {
         Bus.$emit('location_bp_deleting', index, boundaryPoint)
       }
     }
   }
 }
</script>


