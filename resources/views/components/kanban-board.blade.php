<div x-data="{
    columns: [
        { name: 'Todo', tasks: [{ id: 1, title: 'First task' }] },
        { name: 'Doing', tasks: [] },
        { name: 'Done', tasks: [] },
    ],
    dragData: null,
    drag(task, col, index) { this.dragData = { task, col, index }; },
    drop(col) {
        if (this.dragData) {
            this.columns[this.dragData.col].tasks.splice(this.dragData.index, 1);
            this.columns[col].tasks.push(this.dragData.task);
            this.dragData = null;
        }
    }
}">
    <div class="flex space-x-4 overflow-x-auto">
        <template x-for="(column, columnIndex) in columns" :key="columnIndex">
            <div class="bg-gray-100 dark:bg-gray-800 rounded p-4 w-64 flex-shrink-0">
                <h3 class="font-semibold mb-2" x-text="column.name"></h3>
                <div class="space-y-2 min-h-[2rem]" @dragover.prevent @drop="drop(columnIndex)">
                    <template x-for="(task, taskIndex) in column.tasks" :key="task.id">
                        <div class="p-2 bg-white dark:bg-gray-700 rounded shadow cursor-move" draggable="true"
                             @dragstart="drag(task, columnIndex, taskIndex)" x-text="task.title"></div>
                    </template>
                </div>
            </div>
        </template>
    </div>
</div>
