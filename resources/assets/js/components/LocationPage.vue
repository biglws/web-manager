<template>
  <el-row style="padding: 0 20px">
    <el-col :span="12">
      <h3>Помещения</h3>
      <location-table :items="items" :loading="loading" />
    </el-col>
    <el-col :offset="1" :span="11">
      <location-actions :action="action" :location="selected" :beacons="beacons" />
    </el-col>
  </el-row>
</template>

<script>
  import LocationActions from './LocationActions.vue'
  import LocationTable from './LocationTable.vue'
  import notify from './../services/notify'

  export default {
    data() {
      return {
        action: 'add',
        loading: true,
        beacons: [],
        selected: {
          name: '',
          description: '',
          boundary_points: [
            {
              id: null,
              location_id: null,
              x: 0,
              y: 0,
              boundary_segments: [
                {
                  id: null,
                  beacon_id: null,
                  boundary_point_id: null,
                  segment_no: 0,
                  distance: 0,
                  from_side: 'left'
                }
              ]
            }
          ]
        },
        items: []
      }
    },
    created() {
      Bus.$on('location_row_selected', (index, location) => {
        this.action = 'edit'
        this.selected = location
      })
      Bus.$on('location_creating', (location) => {
        this.handleCreate(location)
      })
      Bus.$on('location_updating', (location) => {
        this.handleUpdate(location)
      })
      Bus.$on('location_deleting', (index, location) => {
        this.items.splice(index, 1)
        this.handleDelete(location)
      })
      Bus.$on('location_bp_deleting', (index, boundaryPoint) => {
        this.handleBoundaryPointDelete(index, boundaryPoint);
      })
      Bus.$on('location_bp_creating', () => {
        this.selected.boundary_points.push({
          id: null, x: 0, y: 0, boundary_segments: []
        })
      })
      Bus.$on('location_bs_deleting', (pointIndex, segmentIndex, segment) => {
         this.handleBoundarySegmentDelete(pointIndex, segmentIndex, segment);
      })
      Bus.$on('location_bs_creating', (pointIndex, point) => {
        this
         .selected
         .boundary_points[pointIndex]
         .boundary_segments.push({
           id: null,
           segment_no: 0,
           distance: 0,
           from_side: 'left',
           beacon_id: null
         })
      })
      this.fetchLocations();
      this.fetchBeacons();
    },
    methods: {
      handleCreate: function (location) {
        axios.post('/api/location', location)
          .then((response) => {
            if (response.status === 201) {
              this.items.push(location)
              notify('create')
            }
          })
      },
      handleUpdate: function (location) {
        axios.put(`/api/location/${location.id}`, location)
          .then((response) => {
            notify('update')
          })
      },
      handleDelete: function (location) {
        axios.delete(`/api/location/${location.id}`)
          .then((response) => {
            notify('delete')
          })
      },
      handleBoundaryPointDelete: function (index, boundaryPoint) {
        if (this.action === 'edit' && null !== boundaryPoint.id) {
          axios.delete(`/api/boundary_point/${boundaryPoint.id}`)
            .then((response) => {
              notify('delete')
            })
        }
        this.selected.boundary_points.splice(index, 1)
      },
      handleBoundarySegmentDelete: function (pointIndex, segmentIndex, segment) {
        if (this.action === 'edit' && null !== segment.id) {
          axios.delete(`/api/boundary_segment/${segment.id}`)
            .then((response) => {
              notify('delete')
            })
        }
        this
         .selected
         .boundary_points[pointIndex]
         .boundary_segments
         .splice(segmentIndex, 1)
      },
      fetchLocations: function () {
        axios.get('/api/locations?with=boundary_points.boundary_segments')
          .then((response) => {
            this.items = response.data.data
            this.loading = false
          })
          .catch(() => { this.loading = false })
      },
      fetchBeacons: function () {
        axios.get('/api/beacons')
          .then((response) => {
            this.beacons = response.data.data
          })
      }
    },
    components: {
      LocationActions,
      LocationTable
    }
  }
</script>
