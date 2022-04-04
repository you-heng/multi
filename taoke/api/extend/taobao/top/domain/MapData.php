<?php

/**
 * resultList
 * @author auto create
 */
class MapData
{
	
	/** 
	 * 合作伙伴单单补ID，用作“年货节超级单单补”活动合作伙伴奖励统计依据
	 **/
	public $activity_id;
	
	/** 
	 * 百亿补贴信息
	 **/
	public $bybt_info;
	
	/** 
	 * 商品信息-叶子类目id
	 **/
	public $category_id;
	
	/** 
	 * 商品信息-叶子类目名称
	 **/
	public $category_name;
	
	/** 
	 * 链接-宝贝推广链接
	 **/
	public $click_url;
	
	/** 
	 * 商品信息-佣金比率(%)
	 **/
	public $commission_rate;
	
	/** 
	 * 优惠券（元） 若属于预售商品，该优惠券付尾款可用，付定金不可用
	 **/
	public $coupon_amount;
	
	/** 
	 * 链接-宝贝+券二合一页面链接(该字段废弃，请勿再用)
	 **/
	public $coupon_click_url;
	
	/** 
	 * 优惠券信息-优惠券结束时间
	 **/
	public $coupon_end_time;
	
	/** 
	 * 优惠券信息-优惠券满减信息
	 **/
	public $coupon_info;
	
	/** 
	 * 优惠券信息-优惠券剩余量
	 **/
	public $coupon_remain_count;
	
	/** 
	 * 链接-宝贝+券二合一页面链接
	 **/
	public $coupon_share_url;
	
	/** 
	 * 优惠券信息-优惠券起用门槛，满X元可用。如：满299元减20元
	 **/
	public $coupon_start_fee;
	
	/** 
	 * 优惠券信息-优惠券开始时间
	 **/
	public $coupon_start_time;
	
	/** 
	 * 优惠券信息-优惠券总量
	 **/
	public $coupon_total_count;
	
	/** 
	 * 额外奖励活动金额，活动奖励金额的类型与cpa_reward_type字段对应，如果一个商品有多个奖励类型，返回结果使用空格分割
	 **/
	public $cpa_reward_amount;
	
	/** 
	 * 额外奖励活动类型，如果一个商品有多个奖励类型，返回结果使用空格分割，0=单单奖励(已失效)，1=超级单单奖励(已失效)，2=年货节单单奖励
	 **/
	public $cpa_reward_type;
	
	/** 
	 * 选品库信息
	 **/
	public $favorites_info;
	
	/** 
	 * 是否是热门商品，0不是，1是
	 **/
	public $hot_flag;
	
	/** 
	 * 是否品牌快抢，0不是，1是
	 **/
	public $is_brand_flash_sale;
	
	/** 
	 * 商品信息-宝贝描述（推荐理由,不一定有）
	 **/
	public $item_description;
	
	/** 
	 * 商品信息-宝贝id
	 **/
	public $item_id;
	
	/** 
	 * 拼团专用-拼团几人团
	 **/
	public $jdd_num;
	
	/** 
	 * 拼团专用-拼团拼成价，单位元
	 **/
	public $jdd_price;
	
	/** 
	 * 聚划算商品价格卖点描述
	 **/
	public $jhs_price_usp_list;
	
	/** 
	 * 聚划算信息-聚淘结束时间
	 **/
	public $ju_online_end_time;
	
	/** 
	 * 聚划算信息-聚淘开始时间
	 **/
	public $ju_online_start_time;
	
	/** 
	 * 聚划算满减  -结束时间（毫秒）
	 **/
	public $ju_play_end_time;
	
	/** 
	 * 聚划算满减  -开始时间（毫秒）
	 **/
	public $ju_play_start_time;
	
	/** 
	 * 聚划算信息-商品预热开始时间（毫秒）
	 **/
	public $ju_pre_show_end_time;
	
	/** 
	 * 聚划算信息-商品预热结束时间（毫秒）
	 **/
	public $ju_pre_show_start_time;
	
	/** 
	 * 跨店满减信息
	 **/
	public $kuadian_promotion_info;
	
	/** 
	 * 商品信息-一级类目ID
	 **/
	public $level_one_category_id;
	
	/** 
	 * 商品信息-一级类目名称
	 **/
	public $level_one_category_name;
	
	/** 
	 * 锁住的佣金率
	 **/
	public $lock_rate;
	
	/** 
	 * 锁佣结束时间
	 **/
	public $lock_rate_end_time;
	
	/** 
	 * 锁佣开始时间
	 **/
	public $lock_rate_start_time;
	
	/** 
	 * 猫超买返卡信息
	 **/
	public $maifan_promotion;
	
	/** 
	 * 猫超玩法信息-折扣条件，价格百分数存储，件数按数量存储。可以有多个折扣条件，与折扣字段对应，','分割
	 **/
	public $maochao_play_conditions;
	
	/** 
	 * 猫超玩法信息-玩法类型，2:折扣(满n件折扣),5:减钱(满n元减m元)
	 **/
	public $maochao_play_discount_type;
	
	/** 
	 * 猫超玩法信息-折扣，折扣按照百分数存储，其余按照单位分存储。可以有多个折扣，','分割
	 **/
	public $maochao_play_discounts;
	
	/** 
	 * 猫超玩法信息-活动结束时间，精确到毫秒
	 **/
	public $maochao_play_end_time;
	
	/** 
	 * 猫超玩法信息-当前是否包邮，1:是，0:否
	 **/
	public $maochao_play_free_post_fee;
	
	/** 
	 * 猫超玩法信息-活动开始时间，精确到毫秒
	 **/
	public $maochao_play_start_time;
	
	/** 
	 * 多件券单品件数
	 **/
	public $multi_coupon_item_count;
	
	/** 
	 * 多件券优惠比例
	 **/
	public $multi_coupon_zk_rate;
	
	/** 
	 * 商品信息-新人价
	 **/
	public $new_user_price;
	
	/** 
	 * 店铺信息-卖家昵称
	 **/
	public $nick;
	
	/** 
	 * 拼团专用-拼团结束时间
	 **/
	public $oetime;
	
	/** 
	 * 拼团专用-拼团一人价（原价)，单位元
	 **/
	public $orig_price;
	
	/** 
	 * 拼团专用-拼团开始时间
	 **/
	public $ostime;
	
	/** 
	 * 商品信息-商品主图
	 **/
	public $pict_url;
	
	/** 
	 * 1聚划算满减：满N件减X元，满N件X折，满N件X元）  2天猫限时抢：前N分钟每件X元，前N分钟满N件每件X元，前N件每件X元）
	 **/
	public $play_info;
	
	/** 
	 * 预售商品-定金（元）
	 **/
	public $presale_deposit;
	
	/** 
	 * 预售商品-优惠信息
	 **/
	public $presale_discount_fee_text;
	
	/** 
	 * 预售商品-付定金结束时间（毫秒）
	 **/
	public $presale_end_time;
	
	/** 
	 * 预售商品-付定金开始时间（毫秒）
	 **/
	public $presale_start_time;
	
	/** 
	 * 预售商品-付尾款结束时间（毫秒）
	 **/
	public $presale_tail_end_time;
	
	/** 
	 * 预售商品-付尾款开始时间（毫秒）
	 **/
	public $presale_tail_start_time;
	
	/** 
	 * 多件券件单价
	 **/
	public $price_after_multi_coupon;
	
	/** 
	 * 满减满折优惠（满2件打5折中值为5；满300减20中值为20）
	 **/
	public $promotion_condition;
	
	/** 
	 * 满减满折门槛（满2件打5折中值为2；满300减20中值为300）
	 **/
	public $promotion_discount;
	
	/** 
	 * 满减满折信息
	 **/
	public $promotion_info;
	
	/** 
	 * 满减满折的类型（1. 满减 2. 满折）
	 **/
	public $promotion_type;
	
	/** 
	 * 商品信息-一口价
	 **/
	public $reserve_price;
	
	/** 
	 * 活动价
	 **/
	public $sale_price;
	
	/** 
	 * 拼团专用-拼团已售数量
	 **/
	public $sell_num;
	
	/** 
	 * 店铺信息-卖家id
	 **/
	public $seller_id;
	
	/** 
	 * 店铺信息-店铺名称
	 **/
	public $shop_title;
	
	/** 
	 * 商品信息-商品短标题
	 **/
	public $short_title;
	
	/** 
	 * 商品信息-商品小图列表
	 **/
	public $small_images;
	
	/** 
	 * 拼团专用-拼团剩余库存
	 **/
	public $stock;
	
	/** 
	 * 商品子标题
	 **/
	public $sub_title;
	
	/** 
	 * 是否品牌精选，0不是，1是
	 **/
	public $superior_brand;
	
	/** 
	 * 商品信息-商品标题
	 **/
	public $title;
	
	/** 
	 * 天猫限时抢可售  -结束时间（毫秒）
	 **/
	public $tmall_play_activity_end_time;
	
	/** 
	 * 营销-天猫营销玩法
	 **/
	public $tmall_play_activity_info;
	
	/** 
	 * 天猫限时抢可售  -开始时间（毫秒）
	 **/
	public $tmall_play_activity_start_time;
	
	/** 
	 * 前N件佣金信息-前N件佣金生效或预热时透出以下字段
	 **/
	public $topn_info;
	
	/** 
	 * 拼团专用-拼团库存数量
	 **/
	public $total_stock;
	
	/** 
	 * 淘抢购商品专用-结束时间
	 **/
	public $tqg_online_end_time;
	
	/** 
	 * 淘抢购商品专用-开团时间
	 **/
	public $tqg_online_start_time;
	
	/** 
	 * 淘抢购商品专用-已抢购数量
	 **/
	public $tqg_sold_count;
	
	/** 
	 * 淘抢购商品专用-总库存
	 **/
	public $tqg_total_count;
	
	/** 
	 * 商品入驻淘特后产生的所有销量量级，不特指某段具体时间
	 **/
	public $tt_sold_count;
	
	/** 
	 * 店铺信息-卖家类型，0表示淘宝，1表示天猫，3表示特价版
	 **/
	public $user_type;
	
	/** 
	 * 商品信息-预售数量
	 **/
	public $uv_sum_pre_sale;
	
	/** 
	 * 商品信息-30天销量
	 **/
	public $volume;
	
	/** 
	 * 商品信息-商品白底图
	 **/
	public $white_image;
	
	/** 
	 * 商品信息-商品关联词
	 **/
	public $word_list;
	
	/** 
	 * 物料块id(测试中请勿使用)
	 **/
	public $x_id;
	
	/** 
	 * 预售有礼-推广链接
	 **/
	public $ysyl_click_url;
	
	/** 
	 * 预售有礼-佣金比例（ 预售有礼活动享受的推广佣金比例，注：推广该活动有特殊分成规则，请详见：https://tbk.bbs.taobao.com/detail.html?appId=45301&postId=9334376 ）
	 **/
	public $ysyl_commission_rate;
	
	/** 
	 * 预售有礼-预估淘礼金（元）
	 **/
	public $ysyl_tlj_face;
	
	/** 
	 * 预售有礼-淘礼金发放时间
	 **/
	public $ysyl_tlj_send_time;
	
	/** 
	 * 预售有礼-淘礼金使用结束时间
	 **/
	public $ysyl_tlj_use_end_time;
	
	/** 
	 * 预售有礼-淘礼金使用开始时间
	 **/
	public $ysyl_tlj_use_start_time;
	
	/** 
	 * 折扣价（元） 若属于预售商品，付定金时间内，折扣价=预售价
	 **/
	public $zk_final_price;	
}
?>