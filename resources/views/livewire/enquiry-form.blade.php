<div>
    @if($sent)
        <div style="background:#dcfce7;border:1px solid #86efac;border-radius:8px;padding:16px;text-align:center;">
            <p style="color:#15803d;font-weight:600;margin:0;">✓ Enquiry sent! The seller will contact you soon.</p>
        </div>
    @else
        <form wire:submit="submit">
            <h6 class="fw-7 mb-16" style="font-size:14px;">Send Enquiry</h6>

            <div class="mb-12">
                <input wire:model="name" type="text" placeholder="Your Name *"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;font-family:inherit;">
                @error('name') <span style="font-size:12px;color:#dc2626;">{{ $message }}</span> @enderror
            </div>

            <div class="mb-12">
                <input wire:model="email" type="email" placeholder="Email Address *"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;font-family:inherit;">
                @error('email') <span style="font-size:12px;color:#dc2626;">{{ $message }}</span> @enderror
            </div>

            <div class="mb-12">
                <input wire:model="phone" type="tel" placeholder="Phone / WhatsApp"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;font-family:inherit;">
            </div>

            <div class="mb-16">
                <textarea wire:model="message" rows="4" placeholder="Your message... *"
                          style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;font-family:inherit;resize:vertical;"></textarea>
                @error('message') <span style="font-size:12px;color:#dc2626;">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    wire:loading.attr="disabled"
                    class="sc-button"
                    style="width:100%;justify-content:center;">
                <span wire:loading.remove>Send Enquiry</span>
                <span wire:loading>Sending…</span>
            </button>
        </form>
    @endif
</div>
