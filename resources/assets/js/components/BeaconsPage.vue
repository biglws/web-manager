<template>
  <el-row style="padding: 0 20px">
    <el-col :span="12">
      <h3>Маячки</h3>
      <beacons-table :items="items" :loading="loading" />
    </el-col>
    <el-col :offset="1" :span="11">
      <beacon-actions :action="action" :beacon="selected" />
    </el-col>
  </el-row>
</template>

<script>
  import BeaconActions from './BeaconActions.vue'
  import BeaconsTable from './BeaconTable.vue'
  import notify from './../services/notify'

  const payloadTransformer = (beacon) => {
    if (beacon instanceof Date) {
      beacon.buyed_at = buyed_at.toISOString()
    }

    return beacon;
  }

  export default {
    data() {
      return {
        action: 'add',
        loading: true,
        selected: {
          name: '',
          identity: '',
          buyed_at: ''
        },
        items: []
      };
    },
    created() {
      Bus.$on('beacon_row_selected', (index, beacon) => {
        this.action = 'edit'
        this.selected = beacon
      })
      Bus.$on('beacon_creating', (beacon) => {
        this.handleCreate(beacon)
      })
      Bus.$on('beacon_updating', (beacon) => {
        this.handleUpdate(beacon)
      })
      Bus.$on('beacon_deleting', (index, beacon) => {
        this.items.splice(index, 1)
        this.handleDelete(beacon);
      })
      this.fetchBeacons();
    },
    methods: {
      handleCreate: function (beacon) {
        axios.post('/api/beacon', payloadTransformer(beacon))
          .then((response) => {
            if (response.status === 201) {
              this.items.push(Object.assign(
                beacon, response.data.data
              ))
              this.clearSelected();
              notify('create')
            }
          })
      },
      handleUpdate: function (beacon) {
        axios.put(`/api/beacon/${beacon.id}`, payloadTransformer(beacon))
          .then((response) => {
            notify('update')
          })
      },
      handleDelete: function (beacon) {
        axios.delete(`/api/beacon/${beacon.id}`)
          .then((response) => {
            notify('delete')
          })
      },
      fetchBeacons: function () {
        axios.get('/api/beacons')
          .then((response) => {
            this.items = response.data.data
            this.loading = false
          })
          .catch(() => { this.loading = false })
      },
      clearSelected: function () {
        this.selected = {
          name: '',
          identity: '',
          buyed_at: ''
        };
      }
    },
    components: {
      BeaconsTable,
      BeaconActions
    }
  }
</script>
