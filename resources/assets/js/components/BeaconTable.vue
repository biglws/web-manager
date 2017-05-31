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
      prop="shortIdentity"
      label="Идентификатор">
        <template scope="scope">
          <el-popover trigger="hover" placement="top">
            <p>Hash: {{ scope.row.identity }}</p>
            <div slot="reference" class="identity-wrapper">
                {{ shortIdentity(scope.row.identity) }}
            </div>
          </el-popover>
        </template>
    </el-table-column>
    <el-table-column
      prop="buyed_at"
      label="Дата покупки">
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
      shortIdentity: function(identity) {
        return identity.substr(0, 14) + '...'
      },
      handleEdit(index, row) {
        Bus.$emit('beacon_row_selected', index, row)
      },
      handleDelete(index, row) {
        this.$confirm('Маячок будет удален. Продолжить?', 'Внимание', {
          confirmButtonText: 'Удалить',
          cancelButtonText: 'Отмена',
          type: 'warning'
        }).then(() => {
          Bus.$emit('beacon_deleting', index, row)
        })
      }
    }
  }
</script>
