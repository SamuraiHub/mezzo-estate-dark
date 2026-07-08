<?php
/**
 * Template Name: Services
 * Matches the Figma "Services Page" design.
 *
 * @package Estatein_Dark
 */

get_header();

$blocks = array(
	array(
		'title' => 'Unlock Property Value',
		'desc'  => 'Selling your property should be a rewarding experience, and at Estatein, we make sure it is. Our Property Selling Service is designed to maximize the value of your property.',
		'cards' => array(
			array( 'value',  'Valuation Mastery', 'Discover the true worth of your property with our expert valuation services.' ),
			array( 'invest', 'Strategic Marketing', 'Selling a property requires more than just a listing; it demands a strategic marketing approach.' ),
			array( 'range',  'Negotiation Wizardry', 'Negotiating the best deal is an art, and our negotiation experts are masters of it.' ),
			array( 'check',  'Closing Success', 'A successful sale is not complete until the closing. We guide you through the intricate closing process.' ),
		),
		'promo' => array( 'Unlock the Value of Your Property Today', 'Ready to unlock the true value of your property? Explore our Property Selling Service categories and let us help you achieve the best deal possible for your valuable asset.' ),
	),
	array(
		'title' => 'Effortless Property Management',
		'desc'  => 'Owning a property should be a pleasure, not a hassle. Estatein\'s Property Management Service takes the stress out of property ownership, offering comprehensive solutions tailored to your needs.',
		'cards' => array(
			array( 'home',   'Tenant Harmony', 'Our Tenant Management services ensure that your tenants have a smooth and reducing vacancies.' ),
			array( 'manage', 'Maintenance Ease', 'Say goodbye to property maintenance headaches. We handle all aspects of property upkeep.' ),
			array( 'value',  'Financial Peace of Mind', 'Managing property finances can be complex. Our financial experts take care of rent collection.' ),
			array( 'check',  'Legal Guardian', 'Stay compliant with property laws and regulations effortlessly.' ),
		),
		'promo' => array( 'Experience Effortless Property Management', 'Ready to experience hassle-free property management? Explore our Property Management Service categories and let us handle the complexities while you enjoy the benefits of property ownership.' ),
	),
);

$invest_cards = array(
	array( 'value',  'Market Insight', 'Stay ahead of market trends with our expert Market Analysis. We provide in-depth insights into real estate market conditions.' ),
	array( 'invest', 'ROI Assessment', 'Make investment decisions with confidence. Our ROI Assessment services evaluate the potential returns on your investments.' ),
	array( 'range',  'Customized Strategies', 'Every investor is unique, and so are their goals. We develop Customized Investment Strategies tailored to your specific needs.' ),
	array( 'manage', 'Diversification Mastery', 'Diversify your real estate portfolio effectively. Our experts guide you in spreading your investments across various property types.' ),
);
?>

<section class="page-hero section--tight">
	<div class="container">
		<h1><?php esc_html_e( 'Elevate Your Real Estate Experience', 'estatein-dark' ); ?></h1>
		<p><?php esc_html_e( 'Welcome to Estatein, where your real estate aspirations meet expert guidance. Explore our comprehensive range of services, each designed to cater to your unique needs and dreams.', 'estatein-dark' ); ?></p>
	</div>
</section>

<section class="section--tight">
	<div class="container"><?php get_template_part( 'template-parts/feature-cards' ); ?></div>
</section>

<?php foreach ( $blocks as $b ) : ?>
<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php echo esc_html( $b['title'] ); ?></h2>
			<p><?php echo esc_html( $b['desc'] ); ?></p>
		</div>
		<div class="grid grid-3">
			<?php foreach ( array_slice( $b['cards'], 0, 3 ) as $c ) : ?>
				<div class="service-card"><span class="v-icon"><?php estatein_e_icon( $c[0] ); ?></span><h4><?php echo esc_html( $c[1] ); ?></h4><p><?php echo esc_html( $c[2] ); ?></p></div>
			<?php endforeach; ?>
		</div>
		<div class="grid grid-2" style="margin-top:24px;grid-template-columns:1fr 2fr">
			<?php $c = $b['cards'][3]; ?>
			<div class="service-card"><span class="v-icon"><?php estatein_e_icon( $c[0] ); ?></span><h4><?php echo esc_html( $c[1] ); ?></h4><p><?php echo esc_html( $c[2] ); ?></p></div>
			<div class="service-card" style="display:flex;align-items:center;justify-content:space-between;gap:20px;background:radial-gradient(120% 140% at 90% 50%, rgba(112,59,247,.14), transparent 60%),var(--surface)">
				<div><h4 style="margin-bottom:8px"><?php echo esc_html( $b['promo'][0] ); ?></h4><p><?php echo esc_html( $b['promo'][1] ); ?></p></div>
				<a class="btn" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" style="flex:none"><?php esc_html_e( 'Learn More', 'estatein-dark' ); ?></a>
			</div>
		</div>
	</div>
</section>
<?php endforeach; ?>

<!-- SMART INVESTMENTS -->
<section class="section">
	<div class="container two-col">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Smart Investments, Informed Decisions', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'Building a real estate portfolio requires a strategic approach. Estatein\'s Investment Advisory Service empowers you to make smart investments and informed decisions.', 'estatein-dark' ); ?></p>
			<div class="service-card" style="margin-top:20px;background:var(--bg)"><h4><?php esc_html_e( 'Unlock Your Investment Potential', 'estatein-dark' ); ?></h4><p><?php esc_html_e( 'Explore our Property Management Service categories and let us handle the complexities while you enjoy the benefits of property ownership.', 'estatein-dark' ); ?></p><a class="btn" href="#" style="margin-top:14px"><?php esc_html_e( 'Learn More', 'estatein-dark' ); ?></a></div>
		</div>
		<div class="grid grid-2">
			<?php foreach ( $invest_cards as $c ) : ?>
				<div class="service-card"><span class="v-icon"><?php estatein_e_icon( $c[0] ); ?></span><h4><?php echo esc_html( $c[1] ); ?></h4><p><?php echo esc_html( $c[2] ); ?></p></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_footer();
