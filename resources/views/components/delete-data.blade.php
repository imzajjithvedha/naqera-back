@props(['data'])

<div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-2 p-3 text-center sm:mx-4 sm:p-8">
        <div class="w-14 h-14 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-3 sm:mb-5">
            <i class="bi bi-exclamation-triangle text-red-500 text-2xl"></i>
        </div>
        <p class="font-raleway text-xl font-semibold text-(--color-primary) mb-0.75 sm:mb-2 sm:text-2xl ">Are you sure?</h3>
        <p class="text-[15px] text-(--color-primary) leading-relaxed mb-4 sm:mb-6 sm:text-base">
            Deleting this {{ $data }} will permanently remove all associated data. This action cannot be undone.
        </p>
        <div class="flex gap-3">
            <button type="button" id="delete-cancel"
                class="flex-1 py-3.5 border border-(--color-light-gray) text-base font-medium text-(--color-primary) cursor-pointer transition duration-300 hover:bg-(--color-light-white)">
                Cancel
            </button>
            <form id="delete-form" action="" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full py-3.5 bg-(--color-red) text-white text-base font-medium cursor-pointer transition duration-300 hover:bg-red-800">
                    <i class="bi bi-trash3 mr-1"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
