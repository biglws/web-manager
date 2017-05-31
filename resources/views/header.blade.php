<app-header inline-template>
  <header id="header">
    <el-menu theme="dark" :default-active="activeIndex" mode="horizontal" @select="handleSelect">
      <el-menu-item index="1">Bigl</el-menu-item>
      <el-menu-item index="2">
        <a href="{{ route('beacons') }}">Маячки</a>
      </el-menu-item>
      <el-menu-item index="3">
        <a href="{{ route('locations') }}">Помещения</a>
      </el-menu-item>
      {{--<el-submenu index="3">
        <template slot="title">Помещения</template>
        <el-menu-item index="3-1">Добавить по точкам</el-menu-item>
        <el-menu-item index="3-2">Добавить на карте</el-menu-item>
        <el-menu-item index="3-3">Показать все</el-menu-item>
      </el-submenu>--}}
      {{--<el-menu-item index="4">Карта перемещений</el-menu-item>--}}
      <div class="menu-right__header">
        <el-submenu index="5">
          <template slot="title">{{ Auth::user()->name ?? null }}</template>
          <el-menu-item index="5-1">
            <a href="{{ route('logout') }}" onclick="
            event.preventDefault();
            document.getElementById('logout-form').submit();
          ">Выйти</a>
          </el-menu-item>
        </el-submenu>
      </div>
    </el-menu>
    <div class="line"></div>
  </header>
</app-header>
