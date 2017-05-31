<template>
  <data-tables
    v-loading.body="loading"
    :data="items"
    :search-def="{ show: false }"
    :has-action-col="false"
    border
    stripe
    highlight-current-row
  >
    <el-table-column
      prop="id"
      label="#"
      min-width="40">
    </el-table-column>
    <el-table-column
      prop="name"
      label="Имя">
    </el-table-column>
    <el-table-column
      prop="description"
      label="Описание">
    </el-table-column>
    <el-table-column
      prop="boundary_points"
      label="Точки">
      <template scope="scope">
        <el-popover trigger="hover" placement="top">
          <p
            v-for="item in scope.row.boundary_points"
            :key="item.id"
          >
            Point X {{ item.x }}, Y {{ item.y }}
          </p>
          <div slot="reference" class="identity-wrapper">
            <a href="#">Показать</a>
          </div>
        </el-popover>
      </template>
    </el-table-column>
    <el-table-column
      label="Операции"
      width="120">
      <template scope="scope">
        <el-button
          size="small"
          icon="edit"
          @click="handleEdit(scope.$index, scope.row)">
        </el-button>
        <el-button
          size="small"
          type="danger"
          icon="delete"
          @click="handleDelete(scope.$index, scope.row, items)">
        </el-button>
      </template>
    </el-table-column>
  </data-tables>
</template>

<script>
  export default {
    props: {
      loading: {
        type: Boolean,
        default: false
      },
      items: {
        type: Array,
        default: []
      }
    },
    methods: {
      handleEdit(index, row) {
        Bus.$emit('location_row_selected', index, row)
      },
      handleDelete(index, row) {
        this.$confirm('Помещение будет удалено. Продолжить?', 'Внимание', {
          confirmButtonText: 'Удалить',
          cancelButtonText: 'Отмена',
          type: 'warning'
        }).then(() => {
          Bus.$emit('location_deleting', index, row)
        })
      }
    }
  }
</script>
