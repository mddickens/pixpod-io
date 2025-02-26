<x-filament-panels::page>
	<x-filament::section>
		<x-slot name="heading">
			Stripe Checkout
		</x-slot>

		<x-slot name="description">
			For your security, we use Stripe.com for payment.	Your credit card numbers or bank information are <span class="underline">never</span> stored on our server.<br />
			Please note that all payments will be shown on your account statements as payable to Precision&nbsp;Laser&nbsp;Art&nbsp;LLC, the owner of this website.
		</x-slot>

		<div id="checkout"></div>

	</x-filament::section>
	<script type="text/javascript">
		const stripe = Stripe('{{ getStripePK() }}');

		initialize();

		async function initialize() {
			const fetchClientSecret = async () => {
				const response = await fetch("/api/checkout/{{ $record->uid }}", {
					method: "POST",
				});
				const {
					clientSecret
				} = await response.json();
				return clientSecret;
			};

			const checkout = await stripe.initEmbeddedCheckout({
				fetchClientSecret,
			});

			checkout.mount('#checkout');
		}
	</script>
</x-filament-panels::page>
