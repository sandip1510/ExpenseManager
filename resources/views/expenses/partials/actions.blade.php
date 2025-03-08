<div class="flex space-x-2">
    <!-- View Button -->
    <form action="{{ route('expenses.show', $expense->id) }}" method="GET">
        <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition flex items-center">
            <i class="fas fa-eye mr-1"></i> View
        </button>
    </form>

    <!-- Edit Button -->
    <form action="{{ route('expenses.edit', $expense->id) }}" method="GET">
        <button type="submit"
                class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-600 transition flex items-center">
            <i class="fas fa-edit mr-1"></i> Edit
        </button>
    </form>

    <!-- Delete Button -->
    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" 
          onsubmit="return confirm('Are you sure?');">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition flex items-center">
            <i class="fas fa-trash mr-1"></i> Delete
        </button>
    </form>
</div>
