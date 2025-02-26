<x-filament-panels::page>

	<x-filament-panels::form>

		{{ $this->form }}

		<div class="fi-ac gap-3 flex flex-wrap items-center justify-start">
			<x-filament::button wire:click="submit">
				Save Settings
			</x-filament::button>

			<x-filament::button tag="a" color="gray" href="{{ secure_url('/admin') }}">
				Cancel
			</x-filament::button>
		</div>

	</x-filament-panels::form>

</x-filament-panels::page>