
<div class="modal fade" id="createProductModal" tabindex="-1"
    aria-labelledby="createProductModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">
                    Create Product
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="productForm"
                  method="POST" 
                  action="{{ route('products.store') }}"
                  enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="_method" id="methodField" value="PUT" disabled>

                <div class="modal-body">

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Product Name
                        </label>
                        <input type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            placeholder="Enter product name"
                            required>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">
                            Price
                        </label>
                        <input type="number"
                            class="form-control"
                            id="price"
                            name="price"
                            placeholder="Enter product price"
                            required>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">
                            Stock
                        </label>
                        <input type="number"
                            class="form-control"
                            id="stock"
                            name="stock"
                            placeholder="Enter product stock"
                            required>
                    </div>

                    <!-- Description -->
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea
        class="form-control"
        id="description"
        name="description"
        rows="3"
    ></textarea>
</div>

<!-- Image -->
<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input
        type="file"
        class="form-control"
        id="image"
        name="image"
        accept="image/*"
    >
</div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit" class="btn btn-primary" id="submitProduct">
                        Save changes
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
