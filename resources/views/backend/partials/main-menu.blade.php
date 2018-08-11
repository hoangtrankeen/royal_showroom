<div class="main-menu">
	<header class="header">
		<a href="/admin" class="logo">Royal</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<a href="#" class="avatar"><img src="http://placehold.it/80x80" alt=""><span class="status online"></span></a>

			@if(Auth::guard('admin')->check())
			<h5 class="name"><a href="profile.html">{{Auth::user()->name}}</a></h5>
			<h5 class="position"></h5>
			@endif
			<!-- /.name -->
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="profile.html"><i class="fa fa-user"></i> Profile</a></div>
					<div class="control-item"><a href="#"><i class="fa fa-gear"></i> Settings</a></div>
					<div class="control-item"><a href="#"><i class="fa fa-sign-out"></i> Log out</a></div>
				</div>
				<!-- /.control-list -->
			</div>
			<!-- /.control-wrap -->
		</div>
		<!-- /.user -->
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation" style="margin-bottom: 155px">

			<ul class="menu js__accordion">
				<li class="current active">
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-table"></i><span>Tài khoản</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						{{--<li><a href="{{route('customer.index')}}">Khách hàng</a></li>--}}
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
			</ul>
			<ul class="menu js__accordion">
				<li class="current active">
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-product-hunt"></i><span>Danh mục sản phẩm</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('product.index')}}">Sản phẩm</a></li>
						<li><a href="{{route('category.index')}}">Danh mục</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
			</ul>
			<ul class="menu js__accordion">
				<li class="current active">
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-table"></i><span>Danh mục bài viết</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('post.index')}}">Bài viết</a></li>
						<li><a href="{{route('topic.index')}}">Danh mục</a></li>
						<li><a href="{{route('tag.index')}}">Tag</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
			</ul>
			<ul class="menu js__accordion">
				<li class="current active">
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-table"></i><span>Thuộc tính</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('attribute.index')}}">Thuộc tính sản phẩm</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
			</ul>
			<ul class="menu js__accordion">
				<li class="current active">
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-cart-plus"></i><span>Đơn hàng</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('order.index')}}">Đơn hàng</a></li>
						<li><a href="{{route('order-status.index')}}">Trạng thái đơn hàng</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
			</ul>

			<ul class="menu js__accordion">
				<li class="current active">
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-cart-plus"></i><span>Sale</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('payment-method.index')}}">Phương thức thanh toán</a></li>
						<li><a href="{{route('shipping-method.index')}}">Phương thức vận chuyển</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
			</ul>

			<ul class="menu js__accordion">
				<li class="current active">
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-bar-chart"></i><span>Thống kê</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						{{--<li><a href="{{route('chart.order.amount',['month' => date('m')])}}">Tổng giá trị các đơn hàng</a></li>--}}
						{{--<li><a href="{{route('chart.order.quantity',['month' => date('m')])}}">Tổng đơn hàng</a></li>--}}
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
			</ul>

		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>