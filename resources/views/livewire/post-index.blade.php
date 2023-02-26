{{-- <div> --}}
{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
{{-- </div> --}}
{{-- {{ dd($posts) }} --}}
<div class="max-w-6xl mx-auto">
    <div class="flex justify-end m-2 p-2">
        <x-jet-button wire:click="showPostModal">Create</x-jet-button>
    </div>
    <div class="m-2 p-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Id</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Image</th>
                                <th scope="col" class="relative px-6 py-3">Edit</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr></tr>
                            @if ($posts->count() > 0)
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img class="w-20 h-20 rounded-full" src="{{ Storage::url($post->image) }}">
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm">
                                            <div class="flex space-x-2">
                                                <x-jet-button wire:click="showEditPostModal({{ $post->id }})">Edit
                                                </x-jet-button>
                                                <x-jet-button class="bg-red-500 hover:bg-red-700"
                                                    wire:click="deletePost({{ $post->id }})">
                                                    Delete
                                                </x-jet-button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="px-3">
                                        <div
                                            class="bg-red-400 rounded py-2 px-3 text-center my-3 text-white
                                        font-semibold">
                                            There's no data yet!</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- <div class="m-2 p-2">Pagination</div> --}}
                </div>
            </div>
        </div>
        <div>
            <x-jet-dialog-modal wire:model="showingPostModal">
                @if ($isEditMode)
                    <x-slot name="title">Update post</x-slot>
                @else
                    <x-slot name="title">Create post</x-slot>
                @endif
                <x-slot name="content">
                    <div class="space-y-8 divide-y divide-gray-200 mt-10">
                        <form enctype="multipart/form-data">
                            <div class="sm:col-span-6 mb-3">
                                <label for="title" class="block text-sm font-semibold text-gray-700"> Post Title
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="title" wire:model.lazy="title" name="title"
                                        class="block w-full rounded-md border border-sky-100 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                                    @error('title')
                                        <span
                                            class="text-white bg-red-600 p-1 rounded mt-8 mb-6 w-full text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="title" class="block text-sm font-semibold text-gray-700"> Post Image
                                </label>
                                <div class="flex">
                                    @if ($oldImage)
                                        <img class="rounded" width="150" height="250"
                                            src="{{ Storage::url($oldImage) }}" alt="old-photo">
                                    @endif
                                    @if ($newImage)
                                        <img width="150" height="250" src="{{ $newImage->temporaryUrl() }}"
                                            alt="photo-preview" class="rounded ml-2">
                                    @endif
                                </div>

                                <div class="mt-1">
                                    <input type="file" id="image" wire:model="newImage" name="newImage"
                                        class="block w-full rounded-md border border-sky-100 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                                    @error('newImage')
                                        <span
                                            class="text-white bg-red-600 p-1 rounded mt-8 mb-6 w-full text-sm">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <label for="body" class="block font-semibold text-sm text-gray-700">Body</label>
                                <div class="mt-1">
                                    <textarea id="body" rows="3" wire:model.lazy="body"
                                        class="block w-full rounded-md border border-sky-100 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
                                    @error('body')
                                        <span
                                            class="text-white bg-red-600 p-1 rounded mt-8 mb-6 w-full text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </form>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    @if ($isEditMode)
                        <x-jet-button wire:click="updatePost">Update</x-jet-button>
                    @else
                        <x-jet-button wire:click="storePost">Store</x-jet-button>
                    @endif
                </x-slot>
            </x-jet-dialog-modal>
        </div>
    </div>
