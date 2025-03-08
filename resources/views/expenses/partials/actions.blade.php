<div class="btn-group" role="group">
    <a href="{{ route('expenses.show', $expense->id) }}" class="btn btn-sm btn-info">
        <i class="fas fa-eye"></i> View 
    </a>
    <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-primary">
        <i class="fas fa-edit"></i> Edit
    </a>
    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
            <i class="fas fa-trash"></i> Delete
        </button>
    </form>
</div>
