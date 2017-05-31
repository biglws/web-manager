<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Map</div>

                    <div class="panel-body">
                        <div id="map">
                            this is map?
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import L from 'leaflet'

    export default {
        mounted() {
            console.log('Component mounted.')
            let map = L.map('map', {
                crs: L.CRS.Simple,
                minZoom: -5
            });

            let bounds = [[0,0], [1000,1000]];
            let image = L.imageOverlay('http://leafletjs.com/examples/crs-simple/uqm_map_400px.png', bounds).addTo(map);
            map.fitBounds(bounds);
        }
    }
</script>

<style>
    #map {
        height: 500px;
    }
</style>
