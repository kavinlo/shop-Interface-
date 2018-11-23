<template>
    <div>

	<header class="page-header">
		<h3>购物车</h3>
	</header>
	
	<div class="contaniner fixed-contb">
		<section class="shopcar" v-for="(v,k) in goods" :key="k">
			<div class="shopcar-checkbox">
				<label for="shopcar"  onselectstart="return false" :class="{'shopcar-checkd':v.checked}" @click="select(k)"></label>
				<input type="checkbox" id="shopcar"/>
			</div>
			<figure><img src="../../assets/images/shopcar-ph01.png"/></figure>
			<dl>
				<dt>{{v.title}}</dt>
				<dd v-for="(v1,k1) in v.attrs" :key="k1">{{v1}}</dd>
				<div class="add">
					<span @click="minus(k)">-</span>
					<input type="text" v-model="v.number" />
					<span @click="plus(k)">+</span>
				</div>
				<h3>￥653.00</h3>
				<small><img src="../../assets/images/shopcar-icon01.png"/></small>
			</dl>
		</section>
		<!--去结算-->
		<div style="margin-bottom: 16%;"></div>
		</div>
		<div class="shop-go">
			<b>合计：￥{{this.totalInfo.total}}</b>
			<span><a href="buy.html">去结算（2）</a></span>
		</div>
    </div>
</template>
<script>
export default {
	data(){
		return {
			goods:[
			{
			id:1,
			title:"超级大品牌服装，现在买只要998",
			attrs:[
				'颜色：经典绮丽款',
				'尺寸：L',
			],
			price:653.00,
			number:3,
			logo:'../../assets/images/shopcar-icon01.png',
			checked:false
			},
			{
			id:2,
			title:"超级大品牌服装，现在买只要998",
			attrs:[
				'颜色：经典绮丽款',
				'尺寸：L',
			],
			price:653.00,
			number:1,
			logo:'../../assets/images/shopcar-icon01.png',
			checked:true
			}
		]
	  }
	},
	computed:{
		totalInfo(){
			let total = 0
			let count = 0
			for(var i=0;i<this.goods.length;i++){
				if( this.goods[i].checked ){
					total += this.goods[i].price * this.goods[i].number
					count += this.goods[i].number
				}
			}
			return {
				count:count,
				total:total
			}
		}
	},
	methods:{
		plus(k){
			this.goods[k].number ++
		},
		minus(k){
			if(this.goods[k].number >1) this.goods[k].number--
		},
		select(k){
			this.goods[k].checked = !this.goods[k].checked
		}
	}
}
</script>

<style>
.add span {
  padding: 0 8px !important;
}
.shop-go {
	width:100%;
	height: 50px;
	font-size: 1.7em;
    font-weight: normal;
	color: #fff;
	line-height: 50px;
	padding: 3% 0;
	position: fixed;
	bottom: 56px;
}
.shop-go b {
	width: 60%;
	background-color: red;
	height: 100%;
	display: inline-block;
	box-sizing: border-box;
	text-align: center;
	font-family: "microsoft yahei";
	background-color: rgba(0,0,0,0.8);
}
.shop-go a {
	color: #fff;
    font-weight: normal;
    width: 40%;
    background-color: #45C018;
    text-align: center;
	display: inline-block;
	font-family: "microsoft yahei";

}
</style>

