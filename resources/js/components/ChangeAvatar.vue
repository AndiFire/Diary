<template>
	<div class="flex justify-center">
		<div class="relative h-64 w-64 mb-6 overflow-hidden rounded-full cursor-pointer">
				<img class="h-full w-full object-cover"
						:src="user.avatar_url"
						alt="User avatar">

			<div class="absolute inset-0 bg-black/30 rounded-full flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity cursor-pointer" @click="showModal = true">
				<span class="text-white text-2xl">✏️</span>   
			</div>
		</div>
	</div>
	<div v-if="showModal" class="fixed inset-0 bg-black/20 flex items-center justify-center z-50">
		<div class="bg-bgSecColor dark:bg-bgSecColor-dark shadow-2xl rounded-lg p-6 w-80 flex flex-col items-center">
			<div class="flex w-full justify-end">
				<button @click="showModal = false">
					<icon name="close" class="cursor-pointer" />
				</button>
			</div>

		  <h2 class="text-lg font-bold mb-4">Изменить аватар</h2>

			<label class="cursor-pointer flex w-full items-center justify-center">
				<div class="w-32 h-32 rounded-full overflow-hidden border border-borderColor-dark hover:border-activeColor flex items-center justify-center">
					<img v-if="preview" :src="preview" class="w-full h-full object-cover" />
					<span v-else>Choose avatar</span>
				</div>
				<input type="file" class="hidden" @change="onFileChange">
			</label>
			<button class="mt-4 px-4 py-2 bg-activeColor dark:bg-activeColor-dark  rounded-2xl hover:scale-105 duration-300"
					  @click="saveAvatar">
				Upload
			</button>
		</div>
	</div>
</template>
<script>
export default {
	props: {
		user: Object
	},

	data() {
		return {
		showModal: false,
		preview: null,
		file: null
		}
	},

	methods: {
		onFileChange(e) {
			const file = e.target.files[0]
			if (!file) return

			if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
			alert('You can upload only JPG, JPEG, JFIF or PNG files')
			return
			}

			if (file.size > 2 * 1024 * 1024) {
			alert('Max 2MB')
			return
			}

			const img = new Image()
			img.src = URL.createObjectURL(file)

			img.onload = () => {
			const SIZE = 256
			const canvas = document.createElement('canvas')
			canvas.width = SIZE
			canvas.height = SIZE

			const ctx = canvas.getContext('2d')
			const minSide = Math.min(img.width, img.height)
			const sx = (img.width - minSide) / 2
			const sy = (img.height - minSide) / 2

			ctx.drawImage(
				img,
				sx, sy, minSide, minSide,
				0, 0, SIZE, SIZE
			)

			canvas.toBlob(blob => {
				this.file = new File([blob], 'avatar.jpg', { type: 'image/jpeg' })
				this.preview = URL.createObjectURL(blob)
			}, 'image/jpeg', 0.9)
			}
		},

		async saveAvatar() {
			if (!this.file) return

			const formData = new FormData()
			formData.append('avatar', this.file)

			const res = await fetch('/user/avatar', {
				method: 'POST',
				body: formData,
				headers: {
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				}
			})

			if (!res.ok) {
				alert('Error uploading avatar')
				return
			}

			const data = await res.json()
			this.user.avatar_url = data.avatar_url
			this.showModal = false
			this.preview = null
		}
	}
}
</script>