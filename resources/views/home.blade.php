@extends('layouts.app')

@section('content')
  <el-row :gutter="20">
    <el-col :span="9" :offset="7">
      <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span style="line-height: 36px;">Панель управления</span>
        </div>
        <div class="item">
          Вы вошли в систему!
        </div>
      </el-card>
    </el-col>
  </el-row>
@endsection
